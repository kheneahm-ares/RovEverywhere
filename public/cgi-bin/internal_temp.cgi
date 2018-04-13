#!/usr/bin/python
import os

temp = os.popen("/opt/vc/bin/vcgencmd measure_temp").readline()
temp = temp.replace("temp=","")
temp = temp.replace("'C", "")
temp = float(temp)
temp = (9/5.0) * temp + 32
print '{0:0.1f}'.format(temp)
