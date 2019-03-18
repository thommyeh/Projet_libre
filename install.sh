#!/bin/bash
if [ ! -d "storage" ];then
echo "Umaru est ta waifu";
mkdir storage
fi
if [ ! -d "storage/framework" ];then
echo "Umaru est ta waifu";
mkdir storage/framework
fi
if [ ! -d "storage/framework/cache" ];then
echo "Umaru est ta waifu";
mkdir storage/framework/cache
fi
if [ ! -d "storage/framework/sessions" ];then
echo "Umaru est ta waifu";
mkdir storage/framework/sessions
fi
if [ ! -d "storage/framework/views" ];then
echo "Umaru est ta waifu";
mkdir storage/framework/views
fi
if [ -d "storage/app" ] && [ ! -d "storage/app/public/files" ];then
 echo "Umaru est ta waifu";
mkdir storage/app/public/files
fi
