git config --global user.name "jonnyATroot"
git config --global user.email "shadow.to.root@gmail.com"
git add *
git commit -a -m "Save %DATE%"
cd ..
git add *
git commit -a -m "Save %DATE%"
git push --all sf
exit