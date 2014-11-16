#coding:utf8
import urllib,urllib2
content = {'content':'这个是中文测试 !','code':'2333'}
res = urllib2.urlopen(url="http://pb.bbo.me/add.php",data=urllib.urlencode(content)).read()
print res