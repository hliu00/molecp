#!/usr/bin/env python
# -*- coding: utf-8 -*-
import os,sys,io
import  xml.dom.minidom
import time
import threading
import re
import pexpect
import codecs
import chardet


from urllib.request import urlopen
sys.stdout = io.TextIOWrapper(sys.stdout.buffer,encoding='utf-8')

def unzip():
	try:
		os.system("java -jar ../../public/apktool.jar d -f ../../public/apk/"+sys.argv[1]+" -o ../../public/unzip/")
	except:
		print("upload faild!")

def change():
	os.system("sudo chmod -R 777 ../../public/unzip/")
	file = '../../public/unzip/AndroidManifest.xml'
	bytes = min(32, os.path.getsize(file))
	raw = open(file, 'rb').read(bytes)
	result = chardet.detect(raw)
	encoding = result['encoding']
	file_object = open(file,'r',encoding='utf-8')
	all_the_text = file_object.read()
	if sys.argv[2]!= 'null':
		package = sys.argv[2]
		data = re.findall(r'package="(.+?)"',all_the_text)
		all_the_text=re.sub(data[0],package,all_the_text)
		o=data[0].split('.')
		n=package.split('.')
		os.system("mv ../../public/unzip/smali/"+o[0]+" ../../public/unzip/smali/"+n[0])
		os.system("mv ../../public/unzip/smali/"+n[0]+"/"+o[1]+" ../../public/unzip/smali/"+n[0]+"/"+n[1])
		os.system("mv ../../public/unzip/smali/"+n[0]+"/"+n[1]+"/"+o[2]+" ../../public/unzip/smali/"+n[0]+"/"+n[1]+"/"+n[2])
	if sys.argv[3]!= 'null':
		data=re.findall(r'<meta-data android:name="gameName" android:value="(.+?)"',all_the_text)
		all_the_text=re.sub(data[0],sys.argv[3],all_the_text)
		string_object=codecs.open('../../public/unzip/res/values/strings.xml','r','utf-8')
		string_text = string_object.read()
		data = re.findall(r'<string name="app_name">(.+?)</string>',string_text)
		string_text=re.sub(data[0],sys.argv[3],string_text)
		string_wopen=codecs.open('../../public/unzip/res/values/strings.xml','w','utf-8')
		string_text=string_text.encode('utf-8','surrogateescape').decode('utf-8','surrogateescape')
		string_wopen.write(string_text)
		string_wopen.close()
		string_object.close()

	if sys.argv[4]!= 'null':
		data=re.findall(r'meta-data android:name="zzchannel" android:value="zz_(.+?)"',all_the_text)
		all_the_text=re.sub(data[0],sys.argv[4],all_the_text)
		data=re.findall(r'<meta-data android:name="channels" android:value="(.+?)"',all_the_text)
		all_the_text=re.sub(data[0],sys.argv[4],all_the_text)
		data=re.findall(r'<meta-data android:name="chid" android:value="yzf_(.+?)"',all_the_text)
		all_the_text=re.sub(data[0],sys.argv[4],all_the_text)
		data=re.findall(r'<meta-data android:name="strKx" android:value="xk_(.+?)"',all_the_text)
		all_the_text=re.sub(data[0],sys.argv[4],all_the_text)
		data=re.findall(r'<meta-data android:name="UMENG_CHANNEL" android:value="(.+?)"',all_the_text)
		all_the_text=re.sub(data[0],sys.argv[4],all_the_text)

	if sys.argv[5]!= 'null':
		os.system("mv -f ../../public/apk/"+sys.argv[5]+" ../../public/unzip/res/drawable-ldpi-v4/icon.png")

	wopen=open(file,'w',encoding='utf-8')
	wopen.write(all_the_text.encode('utf-8','surrogateescape').decode('utf-8','surrogateescape'))
	file_object.close()
	wopen.close()
def pack():
	# if not os.path.exists('../../public/unzip/build'):
	# 	os.mkdir('../../public/unzip/build')
	# os.system('sudo chmod -R 777 ../../public/unzip/')
	os.system('java -jar ../../public/apktool.jar b ../../public/unzip  -o ../../public/apk/000_unsigned.apk')
def sign():
	str = 'new.apk'
	passwd_key='Enter Passphrase for keystore:'
	passwd='111111'
	cmdline='jarsigner -verbose -keystore ../../public/ks2.keystore -signedjar ../../public/apk/'+str+' ../../public/apk/000_unsigned.apk ks2.keystore'
	child = pexpect.spawn(cmdline)
	child.expect(passwd_key)
	child.sendline(passwd)
	child.expect(pexpect.EOF)
	# child.interact()
	child.read()

if __name__ == '__main__':
	unzip()
	time.sleep(0.5)
	change()
	time.sleep(1)
	pack()
	sign()
	time.sleep(5)
	print("new.apk")