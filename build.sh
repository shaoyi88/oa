#!/bin/sh

rm -rf ../oa_build && 
fis release -moupd ../oa_build && 
rm -rf ../oa_build/logs/* && 
rm -rf ../oa_build/oa_application/views/templates_c/* &&
rm -rf ../oa_build/build.sh &&
rm -rf ../oa_build/fis-conf.js &&
rm -rf ../oa_build/oa.sql &&
cd ../oa_build &&
tar -zcvf ../oa_`date +%Y%m%d%H%M`.tar.gz * &&
cd - &&
rm -rf ../oa_build
