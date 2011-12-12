    // by petter wahlman, twitter: @badeip
    // solution to part #1 of http://www.canyoucrackit.co.uk/
    //
    // part2.h will be published along with solutions to the subsequent levels after 12 December 2011

    #include <stdio.h>
    #include <stdint.h>
    #include <malloc.h>
    #include <stdlib.h>
    #include <errno.h>
    #include <string.h>
    #include <time.h>
    #include <sys/types.h>
    #include <sys/mman.h>
    #include <sys/utsname.h>

    #include "part2.h" // see information above

    static char part1[] = {
        0xeb, 0x04, 0xaf, 0xc2, 0xbf, 0xa3, 0x81, 0xec,   0x00, 0x01, 0x00, 0x00, 0x31, 0xc9, 0x88, 0x0c,
        0x0c, 0xfe, 0xc1, 0x75, 0xf9, 0x31, 0xc0, 0xba,   0xef, 0xbe, 0xad, 0xde, 0x02, 0x04, 0x0c, 0x00,
        0xd0, 0xc1, 0xca, 0x08, 0x8a, 0x1c, 0x0c, 0x8a,   0x3c, 0x04, 0x88, 0x1c, 0x04, 0x88, 0x3c, 0x0c,
        0xfe, 0xc1, 0x75, 0xe8, 0xe9, 0x5c, 0x00, 0x00,   0x00, 0x89, 0xe3, 0x81, 0xc3, 0x04, 0x00, 0x00,
        0x00, 0x5c, 0x58, 0x3d, 0x41, 0x41, 0x41, 0x41,   0x75, 0x43, 0x58, 0x3d, 0x42, 0x42, 0x42, 0x42,
        0x75, 0x3b, 0x5a, 0x89, 0xd1, 0x89, 0xe6, 0x89,   0xdf, 0x29, 0xcf, 0xf3, 0xa4, 0x89, 0xde, 0x89,
        0xd1, 0x89, 0xdf, 0x29, 0xcf, 0x31, 0xc0, 0x31,   0xdb, 0x31, 0xd2, 0xfe, 0xc0, 0x02, 0x1c, 0x06,
        0x8a, 0x14, 0x06, 0x8a, 0x34, 0x1e, 0x88, 0x34,   0x06, 0x88, 0x14, 0x1e, 0x00, 0xf2, 0x30, 0xf6,
        0x8a, 0x1c, 0x16, 0x8a, 0x17, 0x30, 0xda, 0x88,   0x17, 0x47, 0x49, 0x75, 0xde, 0x31, 0xdb, 0x89,
        0xd8, 0xfe, 0xc0, 0xcd, 0x80, 0x90, 0x90, 0xe8,   0x9d, 0xff, 0xff, 0xff, 0x41, 0x41, 0x41, 0x41,
    };

    // code to dump the decrypted memory:
    static const char dump_mem[] = {
            0x8d, 0x7f, 0xce,               // lea    edi,[edi-0x32]
            0x57,                           // push   edi
            0x31, 0xc9,                     // xor    ecx,ecx
            0x30, 0xc0,                     // xor    al,al
            0xf7, 0xd1,                     // not    ecx
            0xfc,                           // cld
            0xf2, 0xae,                     // repne scasb
            0xf7, 0xd1,                     // not    ecx
            0x49,                           // dec    ecx
            0x89, 0xca,                     // mov    edx,ecx
            0x5f,                           // pop    edi
            0x89, 0xf9,                     // mov    ecx,edi
            0xb8, 0x04, 0x00, 0x00, 0x00,   // mov    eax,0x4
            0x31, 0xdb,                     // xor    ebx,ebx
            0xfe, 0xc3,                     // inc    bl
            0xcd, 0x80,                     // int    0x80
            0x89, 0xd3,                     // mov    ebx,edx
            0x31, 0xc0,                     // xor    eax,eax
            0xfe, 0xc0,                     // inc    al
            0xcd, 0x80,                     // int    0x80
    };

    uint32_t patch_mem(char *ptr, size_t size)
    {
        uint32_t i;

        for (i = 0; i < size; i++) {
            if (*(uint16_t *)&ptr[i] == 0x80cd) {
                *(uint16_t *)&ptr[i] = 0x45eb;
                return 0;
            }
        }
        return 1;
    }

    uint32_t check_arch(void)
    {
        struct utsname kernel_info;

        uname(&kernel_info);
        return strcmp(kernel_info.machine, "i686") ? 1 : 0;
    }

    int main(int argc, char **argv)
    {
        void *mem;

        if (check_arch()) {
            printf("[-] this program must run on a 32-bit architecture\n");
            return 1;
        }

        printf("[*] allocating page aligned memory\n");
        mem = memalign(4096, 4096);
        if (!mem) {
            printf("[-] error: %s\n", strerror(errno));
            return 1;
        }
        memset(mem, 0, 4096);

        printf("[*] setting page permissions\n");
        if (mprotect(mem, 4096, PROT_READ | PROT_WRITE | PROT_EXEC)) {
            printf("[-] error: %s\n", strerror(errno));
            return 1;
        }

        printf("[*] copying payload\n");

        memcpy(mem, part1, sizeof(part1));
        memcpy(mem + sizeof(part1), part2, sizeof(part2));
        memcpy(mem + sizeof(part1) + sizeof(part2), dump_mem, sizeof(dump_mem));

        printf("[*] adding dump_mem payload\n");
        if (patch_mem(mem, sizeof(part1))) {
            printf("[-] failed to patch memory\n");
            return 0;
        }

        printf("[*] executing payload..\n\n");

        ((int(*)(void))mem)();

        return 0;
    }
