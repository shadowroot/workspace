#!/bin/bash
#SHELL SCRIPT for Progtest

rm result

for file in `find CZE/ | grep [^w]in\.txt`
do
	./a.out < $file > $(echo `echo $file | cut -d _ -f1`_out.txt | tr 'CZE/' '   ')
	echo "Run for $file"
done
for file in `find CZE/ | grep out\.txt`
do
	echo -----------------$file----------------- >> result
        diff $file  `echo $file | cut -d / -f2` >> result
	echo "Diff for $file"
done

cat result

