@rem Do not use "echo off" to not affect any child calls.
@setlocal

@rem Get the abolute path to the current directory, which is assumed to be the
@rem Git installation root.
@set git_install_root=c:\msysgit\msysgit\
@set PATH=%git_install_root%\bin;%git_install_root%\mingw\bin;%git_install_root%\cmd;%PATH%
@set /p HOME= < active.txt
@cd %HOME%
@start %COMSPEC% /k "d:\+WORKSPACE+\set.bat"

