import numpy as np
from controller import Supervisor, Camera
import sys
import cv2
import json
import datetime
import os
import mysql.connector
from datetime import datetime

supervisor = Supervisor()
TIME_STEP = int(supervisor.getBasicTimeStep())
calcux = 0
calcuxs = 0
calcuy = 0
calcuys = 0
lm1 = supervisor.getDevice('lm1')
lm2 = supervisor.getDevice('lm2')
lm3 = supervisor.getDevice('lm3')
lm4 = supervisor.getDevice('lm4')
search = supervisor.getDevice('search')
search.enable(TIME_STEP)
searchs = supervisor.getDevice('search1')
searchs.enable(TIME_STEP)
detector = supervisor.getDevice('detector')
detector.enable(TIME_STEP)
receiver = supervisor.getDevice('receiver')
receiver.enable(TIME_STEP)
camera = supervisor.getDevice("camera")
camera.enable(100)
camera1 = supervisor.getDevice("camera1")
camera1.enable(100)
camera2 = supervisor.getDevice("camera2")
camera2.enable(100)
ds_checker = supervisor.getDevice('ds_checker')
ds_checker.enable(TIME_STEP)
x = 0
y = 0
mps = 0
mps1 = 0
bingss = 0
pu = 0

qr_code_content = set()
qr_code_count = 0  
#angkat brg

def getdev():
  if receiver.getQueueLength() > 0:
    image = receiver.getString()
    receiver.nextPacket()
  
    obj = int(image)
    m = int(image)
    print(f"obj: {m}")
    if(m == 0):
      modet = 1
      go = 0
      steps = 0
      yss = 0
      xs = 0
      ys = 0
      #modes(0, 0, x, y)
    elif(m == 1):
      lm1ss = 0
      lm2s = 0
      count = 0
      check = 0
      cos = 0
      bb = 0
      rowe = 0
      cocko = 0
     # mode(0)
    elif(m == 2):
      count = 0
      check = 0
      cos = 0
      bb = 87
      rowe = 65
      sst = 0
      checku = 0
      checkpoint = 0
      mode1(1)
    elif(m == 3):
     # mode2()
      s=9
    elif(m == 4):
      #mode3()
      s=0
    elif(m == 5):
      mode4()

def machine():
  with open('machine.txt', 'w') as files:
    files.write('0')

def machine1():
  with open('machine.txt', 'w') as files:
    files.write('1')

def getxy(b, s):
  global x
  global y
  global pu
  x = b
  y = s
  pu = 0



  
def qrcode():
    qr_code_count = 0 
    image = camera2.getImage()
    width, height = camera2.getWidth(), camera2.getHeight()
    image_array = np.frombuffer(image, np.uint8).reshape((height, width, 4))
    gray_image = cv2.cvtColor(image_array, cv2.COLOR_BGR2GRAY)
    _, binary_image = cv2.threshold(gray_image, 128, 255, cv2.THRESH_BINARY)
    qr_code_detector = cv2.QRCodeDetector()
    decoded_info, _, _ = qr_code_detector.detectAndDecode(binary_image)
    if decoded_info:
        decoded_info = bytes(decoded_info, encoding='utf-8')
        bingss = str(decoded_info, 'utf-8')  
        print(bingss)
        return bingss

def qrcode_for_inbound():
    qr_code_count = 0 
    image = camera2.getImage()
    width, height = camera2.getWidth(), camera2.getHeight()
    image_array = np.frombuffer(image, np.uint8).reshape((height, width, 4))
    gray_image = cv2.cvtColor(image_array, cv2.COLOR_BGR2GRAY)
    _, binary_image = cv2.threshold(gray_image, 128, 255, cv2.THRESH_BINARY)
    qr_code_detector = cv2.QRCodeDetector()
    decoded_info, _, _ = qr_code_detector.detectAndDecode(binary_image)
    if decoded_info:
        decoded_info = bytes(decoded_info, encoding='utf-8')
        bingss = str(decoded_info, 'utf-8')  
        print(bingss)
        return bingss
    
def qrcode1s():
    qr_code_count = 0 
    image = camera1.getImage()
    width, height = camera.getWidth(), camera.getHeight()
    image_array = np.frombuffer(image, np.uint8).reshape((height, width, 4))
    gray_image = cv2.cvtColor(image_array, cv2.COLOR_BGR2GRAY)
    _, binary_image = cv2.threshold(gray_image, 128, 255, cv2.THRESH_BINARY)
    qr_code_detector = cv2.QRCodeDetector()
    decoded_info, _, _ = qr_code_detector.detectAndDecode(binary_image)
    if decoded_info:
        decoded_info = bytes(decoded_info, encoding='utf-8')
        bingss = str(decoded_info, 'utf-8')  
        print(bingss)
        return bingss
  
def qrcode1():
    qr_code_count = 0 
    image = camera1.getImage()
    width, height = camera1.getWidth(), camera1.getHeight()
    image_array = np.frombuffer(image, np.uint8).reshape((height, width, 4))
    gray_image = cv2.cvtColor(image_array, cv2.COLOR_BGR2GRAY)
    _, binary_image = cv2.threshold(gray_image, 128, 255, cv2.THRESH_BINARY)
    qr_code_detector = cv2.QRCodeDetector()
    decoded_info, _, _ = qr_code_detector.detectAndDecode(binary_image)
    if decoded_info:
        decoded_info = bytes(decoded_info, encoding='utf-8')
        bingss = str(decoded_info, 'utf-8')  
        print(bingss)
        return bingss

    
def ccou(yss):
  if(yss == 0 or yss == 1 or yss == 22 or yss == 23):
    return 11
  elif(yss == 2 or yss == 3 or yss == 24 or yss == 25):
    return 10
  elif(yss == 4 or yss == 5 or yss == 26 or yss == 27):
    return 9
  elif(yss == 6 or yss == 7 or yss == 28 or yss == 29):
    return 8
  elif(yss == 8 or yss == 9 or yss == 30 or yss == 31):
    return 7
  elif(yss == 10 or yss == 11 or yss == 32 or yss == 33):
    return 6
  elif(yss == 12 or yss == 13 or yss == 34 or yss == 35):
    return 5
  elif(yss == 14 or yss == 15 or yss == 36 or yss == 37):
    return 4
  elif(yss == 16 or yss == 17 or yss == 38 or yss == 39):
    return 3
  elif(yss == 18 or yss == 19 or yss == 40 or yss == 41):
    return 2
  elif(yss == 20 or yss == 21 or yss == 42 or yss == 43):
    return 1
  
def lidar_search():
  count = 0
  search_value = searchs.getRangeImage()
  for i in range(500):
    mp = getdev()
    if(mp == 1):
      mp = 0
      break
    if(search_value[i] <= 1.0):
      count = count + 1  
  return count
  
def lidar_search1():
  count = 0
  search_value = searchs.getRangeImage()
  for i in range(500):
    mp = getdev()
    if(mp == 1):
      mp = 0
      break
    if(search_value[i] <= 3.1):
      count = count + 1  
  return count

def lidar_search2():
  count = 0
  search_value = searchs.getRangeImage()
  for i in range(500):
    mp = getdev()
    if(mp == 1):
      mp = 0
      break
    if(search_value[i] <= 3.6):
      count = count + 1  
  return count

def lidar_search3():
  count = 0
  search_value = searchs.getRangeImage()
  for i in range(500):
    mp = getdev()
    if(mp == 1):
      mp = 0
      break
    if(search_value[i] <= 5):
      count = count + 1  
  return count

def lidar_searchs():
  count = 0
  search_values = search.getRangeImage()
  for i in range(500):
    mp = getdev()
    if(mp == 1):
      mp = 0
      break
    if(search_values[i] <= 1.0):
      count = count + 1  
  print(search_values)
  return count  

def detectors():
  search_values = detector.getRangeImage()
  count = 0
  for i in range(500):
    if search_values[i] < 1.17:
      count = count + 1
  print(search_values)
  return count

def detectors1():
  search_values = detector.getRangeImage()
  count = 0
  for i in range(500):
    if search_values[i] > 0.7:
      count = count + 1
  return count
    
def lidar_searchs1():
  count = 0
  search_values = search.getRangeImage()
  for i in range(500):
    mp = getdev()
    if(mp == 1):
      mp = 0
      break
    if(search_values[i] <= 3.0):
      count = count + 1  
  return count  

def lidar_searchs2():
  count = 0
  search_values = search.getRangeImage()
  for i in range(500):
    mp = getdev()
    if(mp == 1):
      mp = 0
      break
    if(search_values[i] <= 3.53):
      count = count + 1  
  return count  

def lidar_searchs3():
  count = 0
  search_values = search.getRangeImage()
  for i in range(500):
    mp = getdev()
    if(mp == 1):
      mp = 0
      break
    if(search_values[i] <= 4.9):
      count = count + 1  
  return count  

def count_cc(cc, passive):
  roll = (cc*4) + passive
  return roll

def step():
  if (supervisor.step(TIME_STEP) == -1):
    supervisor.stepEnd()

def passive_wait(sec):
  start_time = supervisor.getTime()
  print(start_time)
  while (start_time + sec > supervisor.getTime()):
    print(supervisor.getTime(), start_time+sec)
    step()

def forcount(y):
  ss = 0
  if(y <= 20):
    ss = y/2
    
  elif(y > 20):
    ss = (y-22)/2

  if(ss == 0):
    return 32
  elif(ss == 1):
    return 29
  elif(ss == 2):
    return 26
  elif(ss == 3):
    return 23
  elif(ss == 4):
    return 20
  elif(ss == 5):
    return 17
  elif(ss == 6):
    return 14
  elif(ss == 7):
    return 11
  elif(ss == 8):
    return 8
  elif(ss == 9):
    return 5
  elif(ss == 10):
    return 2


#done 1.0
def read():
    matrix = np.empty((44,66))
    date_time_format = "%Y-%m-%d %H:%M:%S"
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="warehouse"
    )
    mycursor = mydb.cursor()
    mycursor.execute("SELECT location.Columns, location.Row, stacker_crane.Name FROM location inner join stacker_crane on stacker_crane.StackerCraneID = location.StackerCraneID where stacker_crane.Name = 'M01' and Status = '1'")
    myresult = mycursor.fetchall()
    print(matrix)
    
    if myresult:
      for x in myresult:
        matrix[x[0]][x[1]] = 1
    
    file_path = "matrix.txt"
    with open(file_path, 'w') as file:
        for x in range(44):
            for y in range(66):
                if matrix[x][y] == 1.0:
                    matrix[x][y] = 1
                    file.write('1')
                else:
                    matrix[x][y] = 0
                    file.write('0')
                if(y != 65):
                  file.write(' ')
                  
            file.write('\n')
    print(matrix)
    return matrix

def move1(lm1ss, lm2s):
  lm1.setVelocity(2.5)
  lm1.setPosition(lm1ss)
  lm2.setVelocity(1)
  lm2.setPosition(lm2s)

def compa(x):
  if(x == 0):
    passive_wait(7+x)
          
  elif(x > 0):
    passive_wait(4+ x)
  modet = 2
  return modet

def compa1(xs, yss, ys, x):
  if(xs == 0):
    calcuy = yss - ys
    calcuys = ys - yss
    print(calcuy, calcuys)
    if(calcuy >= 0):
      calcux = x - xs
      calcuxs = xs - x
      if(calcux >= 0):
        passive_wait(8+calcuy+calcux)
      elif(calcux < 0):
        passive_wait(8+calcuy+calcuxs)
      steps = 4
        
    elif(calcuy < 0):
      passive_wait(4+calcuys)
      calcux = x - xs
      calcuxs = xs - x
      if(calcux >= 0):
        passive_wait(8+calcuys+calcux)
      elif(calcux < 0):
        passive_wait(8+calcuys+calcuxs)
      steps = 4
 
  elif(xs > 0):
    calcuy = yss - ys
    calcuys = ys - yss
    if(calcuy >= 0):
      calcux = x - xs
      calcuxs = xs - x
      if(calcux >= 0):
        passive_wait(6+calcuy+calcux)
      elif(calcux < 0):
        passive_wait(6+calcuy+calcuxs)
      steps = 4
        
    elif(calcuy < 0):
      calcux = x - xs
      calcuxs = xs - x
      if(calcux >= 0):
        passive_wait(6+calcuys+calcux)
      elif(calcux < 0):
        passive_wait(6+calcuys+calcuxs)
      steps = 4
  return steps

def countab(sd, ds):
  print(ds, sd)
  if(sd > ds):
    return sd
  elif(ds > sd):
    return ds

def forcount1(y):
  ss = y
  if(ss == 1 or ss == 12):
    return 32
  elif(ss == 2 or ss == 13):
    return 29
  elif(ss == 3 or ss == 14):
    return 26
  elif(ss == 4 or ss == 15):
    return 23
  elif(ss == 5 or ss == 16):
    return 20
  elif(ss == 6 or ss == 17):
    return 17
  elif(ss == 7 or ss == 18):
    return 14
  elif(ss == 8 or ss == 19):
    return 11
  elif(ss == 9 or ss == 20):
    return 8
  elif(ss == 10 or ss ==  21):
    return 5
  elif(ss == 11 or ss == 22):
    return 2

def forcount2(y):
  ss = y
  if(ss == 0 or ss == 11):
    return 32
  elif(ss == 1 or ss == 12):
    return 29
  elif(ss == 2 or ss == 13):
    return 26
  elif(ss == 3 or ss == 14):
    return 23
  elif(ss == 4 or ss == 15):
    return 20
  elif(ss == 5 or ss == 16):
    return 17
  elif(ss == 6 or ss == 17):
    return 14
  elif(ss == 7 or ss == 18):
    return 11
  elif(ss == 8 or ss == 19):
    return 8
  elif(ss == 9 or ss ==  20):
    return 5
  elif(ss == 10 or ss == 21):
    return 2

def pasiv(y):
  if(y == 1 or y == 3 or y == 5 or y == 7 or y == 9 or y == 11 or y == 13 or y == 15 or y == 17 or y == 19 or y == 21):
    return 0.6
  elif(y == 23 or y == 25 or y == 27 or y == 29 or y == 31 or y == 33 or y == 35 or y == 37 or y == 39 or y == 41 or y == 43):
    return 0.6 
  elif(y == 0 or y == 2 or y == 4 or y == 6 or y == 8 or y == 10 or y == 12 or y == 14 or y == 16 or y == 18 or y == 20):  
    return 0.8
  elif(y == 22 or y == 24 or y ==26 or y == 28 or y == 30 or y == 32 or y == 34 or y == 36 or y == 38 or y == 40 or y == 42):
    return 0.8

def lm3go(y):
  if(y == 1 or y == 3 or y == 5 or y == 7 or y == 9 or y == 11 or y == 13 or y == 15 or y == 17 or y == 19 or y == 21):
    return 1.21
  elif(y == 23 or y == 25 or y == 27 or y == 29 or y == 31 or y == 33 or y == 35 or y == 37 or y == 39 or y == 41 or y == 43):
    return -1.87
  elif(y == 0 or y == 2 or y == 4 or y == 6 or y == 8 or y == 10 or y == 12 or y == 14 or y == 16 or y == 18 or y == 20):
    return 2.7
  elif(y == 22 or y == 24 or y ==26 or y == 28 or y == 30 or y == 32 or y == 34 or y == 36 or y == 38 or y == 40 or y == 42):
    return -3.37
  
#letak brg
def lidar_search0():
  count = 0
  search_value = search.getRangeImage()
  for i in range(500):
    mp = getdev()
    if(mp == 1):
      mp = 0
      break
    if(search_value[i] <= 1.67):
      count = count + 1  
  return count

def sql():
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="warehouse"
    )
    
    return mydb

def checking_database():
    bp = 0
    date_time_format = "%Y-%m-%d %H:%M:%S"
    mydb = sql()

    checkpoint = 0
    checkpoint1 = 0
    mycursor = mydb.cursor()

    mycursor.execute("SELECT inbound.Date, inbound.Time, stacker_crane.Name, product.Product_Name, inbound.InBoundID, inbound.StackerCraneID, product.ProductID FROM inbound inner join stacker_crane on stacker_crane.StackerCraneID = inbound.StackerCraneID inner join product on inbound.ProductID=product.ProductID where inbound.Checkpoint = '0' and inbound.Flag = '0' and stacker_crane.Name = 'M01'")

    myresult = mycursor.fetchall()
    if myresult:
      checkpoint = 1
      count  = 0
      min = 0
      time = str(myresult[0][0]) + " " + str(myresult[0][1])
      datetime1 = datetime.strptime(time, date_time_format)
      for x in myresult:
        time = str(x[0]) + " " + str(x[1])
        if(datetime1 > datetime.strptime(time, date_time_format)):
          min = count
        count= count + 1

    mycursor.execute("SELECT outbound.Date, outbound.Time, location.Columns, location.Row, stacker_crane.StackerCraneID, outbound.OutBoundID, location.LocationID, product.Product_Name FROM outbound inner join location on location.LocationID = outbound.LocationID inner join stacker_crane on stacker_crane.StackerCraneID = location.StackerCraneID inner join product on product.ProductID = location.ProductID where outbound.Flag = '0' and stacker_crane.Name = 'M01'")
    myresult1 = mycursor.fetchall()
    if myresult1:
      count1 = 0
      min1 = 0
      checkpoint1 = 1
      time1 = str(myresult1[0][0]) + " " + str(myresult1[0][1])
      datetime2 = datetime.strptime(time1, date_time_format)
      for x in myresult1:
        time1 = str(x[0]) + " " + str(x[1])
        if(datetime2 > datetime.strptime(time1, date_time_format)):
          min1 = count1
        count1 = count1 + 1
    
    if(checkpoint == 1 and checkpoint1 == 1):
      time = str(myresult[min][0]) + " " + str(myresult[min][1])  
      time1 = str(myresult1[min1][0]) + " " + str(myresult1[min1][1])
    
      datetime1 = datetime.strptime(time, date_time_format)
      datetime2 = datetime.strptime(time1, date_time_format)

      if(datetime1 < datetime2):
        print("Inbound has been selected")
        print(myresult[min])
        data=["1", myresult[min][2], myresult[min][3], myresult[min][4], myresult[min][5], myresult[min][6]]
        return data
      else:
        print("Outbound has been selected")
        print(myresult1[min1])
        data=["2", myresult1[min1][2], myresult1[min1][3], myresult1[min1][4], myresult1[min1][5], myresult1[min1][6], myresult1[min1][7]]
        return data

        
    elif((checkpoint == 1 and checkpoint1 == 0) or not(checkpoint == 1 and checkpoint1 == 1)):
      datetime1 = datetime.strptime(time, date_time_format)
      print(datetime1)
      print(myresult[min])
      print("Inbound has been selected")
      data=["1", myresult[min][2], myresult[min][3], myresult[min][4], myresult[min][5], myresult[min][6]]
      return data
      
    elif(checkpoint1 == 1 and checkpoint == 0):
      datetime2 = datetime.strptime(time1, date_time_format)
      print(datetime2)
      print(myresult1[min1])
      print("Outbound has been selected")
      data=["2", myresult1[min1][2], myresult1[min1][3], myresult1[min1][4], myresult1[min1][5], myresult1[min1][6], myresult1[min1][7]]
      return data

def update_inboundoutbound_database(column, row, id, productname):
    date_now = datetime.date.today()
    time_now = datetime.datetime.now().time()
    matrix = np.empty((44,66))
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="warehouse"
    )
    mycursor = mydb.cursor()
    sql = "select ProductID from product where Product_Name = %s"
    val = (productname,)
    mycursor.execute(sql, val)
    productid = mycursor.fetchone()
    
    
    if productid:
      id = 3
      sql = "update inbound set Checkpoint = '1', Flag = '1' where InBoundID = %s "
      val = (id,)
      mycursor.execute(sql, val)
      mydb.commit()
    
      sql = "Insert into location(Columns, Row, Date, Time, ProductID, StackerCraneID, Status) values (%s, %s, %s, %s, %s, %s, %s)"
      val = (column, row, date_now, time_now, productid[0], 1, 1)
      mycursor.execute(sql, val)
      mydb.commit()
      
    else:
      print('product doenst exist')

#for outbound
def change_flag(data):
    mydb = sql()
    mycursor = mydb.cursor()
    sql_query = "Update outbound set Flag = '1' where OutBoundID = %s"
    val = (data[4],)
    mycursor.execute(sql_query, val)
    mydb.commit()

    sql_query = "update location set Status = '0' where LocationID = %s"
    val = (data[5],)
    mycursor.execute(sql_query, val)
    mydb.commit()


def check_productname(column, row, stackercrane):
    mydb = sql()
    mycursor = mydb.cursor()
    sql_query = "SELECT product.Product_Name, location.LocationID FROM location INNER JOIN product ON product.ProductID = location.ProductID WHERE Columns = %s AND Row = %s AND StackerCraneID = %s AND Status = 0"
    val = (column, row, stackercrane)
    mycursor.execute(sql_query, val)
    data = mycursor.fetchone()
    return data

#for chganing the location after move over the product
def change_location(Locationid, column, row):
    mydb = sql()
    mycursor = mydb.cursor()
    sql_query = "UPDATE location SET `Columns` = %s, `Row` = %s WHERE LocationID = %s AND Status = '0'"
    val = (column, row, Locationid)
    mycursor.execute(sql_query, val)
    mydb.commit()

#for inbound
def get_productname_inbound(inboundid):
    mydb = sql()
    mycursor = mydb.cursor()
    sql_query = "Select product.Product_Name from inbound inner join product on product.ProductID = inbound.ProductID where inbound.InBoundID = %s"
    val = (inboundid,)
    mycursor.execute(sql_query, val)
    data = mycursor.fetchone()
    print(data)

def add_location(column, row, productid, stackercraneid, inboundid):
    now = datetime.now()  # Use datetime.now() directly
    time_now = now.strftime("%H:%M:%S")
    date_now = now.strftime("%Y-%m-%d")
    mydb = sql()
    mycursor = mydb.cursor()
    sql_query = "insert into location (Time, Date, StackerCraneID, Columns, Row, ProductID) values(%s, %s, %s, %s, %s, %s)"
    val = (time_now, date_now, stackercraneid, column, row, productid)
    mycursor.execute(sql_query, val)
    mydb.commit()

    sql_query = "update inbound set Checkpoint = '1', Flag = '1' where InBoundID = %s "
    val = (inboundid,)
    mycursor.execute(sql_query, val)
    mydb.commit()
#lm1 yellow tiang position 8.3 -- to reverse
#lm2 lift up position 0 ++ to go up
#lm4 stacker position 0  ++ to go up
#lm3 position -0.32 -- to go right side ++ to go left side
def mode1():
  while supervisor.step(TIME_STEP) != -1:

    binggg = qrcode_for_inbound()    
    print(binggg)

def mode4():
  pu = 0
  if(pu == 0):
    dats = checking_database()
    pu = 1
    print(dats)
    bung = 0
    bo = 0

  if(dats[0] == "1"):
    if(bo == 0):
      matrix = read()
      cos = 0
      lm1ss = 4.7
      cc = 0
      lm2s = 6.72
      ttt = 0
      check = 2
      count = 0
      rowe = 0
      cos = 0
      bb = 0
      bo = 3
      cocko = 0
      lm11ss = 8.3
      ping = 0
      sst = 0
      checkus = 0
      checkpoint = 0
      bo = 1
    
    while supervisor.step(TIME_STEP) != -1:
      if receiver.getQueueLength() > 0:
        lm1ss = 0
        lm2s = 0
        count = 0
        check = 0
        cos = 0
        bb = 0
        rowe = 0
        cocko = 0
        bo = 0
        checkus = 0
        checkpoint = 0
        print('stop1')
        return
      
      if(cos == 0):   
        print("pqoqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq")
        for i in range(43):
          for j in range(65):
            if(matrix[i][j] == 1):
              ping = ping + 1 
              
        if (ping == 2795):
          file_paths = "indi.txt"
          with open(file_paths, 'w') as file:
            file.write('Full')
          print(f"Save Successfully")
          bo = 0
          
        elif (ping != 2795):
          file_paths = "indi.txt"
          with open(file_paths, 'w') as file:
            file.write('Proccessing')
          print(f"Save Successfully") 
          cos = 2
        
      if(cocko == 0): 
        machine()
        if(cos == 2): 
          lm1.setVelocity(2.5)
          lm1.setPosition(8.3)
          passive_wait(1)
          lm2.setVelocity(1)
          lm3.setVelocity(1)
          lm2.setPosition(0.27)
          lm3.setPosition(-0.32)
          lm4.setPosition(0.05)
          passive_wait(2)
          cos = 1   
          
        elif(cos == 1):
          lam = detectors()
          if(ds_checker.getValue() < 1000 and lam == 0):
            cos = 1.1
  
        elif(cos == 1.1):
          values = lidar_search0()
          
          if(values >= 1):
            machine1()
            lolol = qrcode()

            if(lolol == dats[2]):
              lm3.setVelocity(1)
              lm3.setPosition(-1.83)
              passive_wait(2)
              lm4.setVelocity(1)
              lm4.setPosition(0.2)
              passive_wait(1)
              lm3.setVelocity(0.7)
              lm3.setPosition(-0.32)
              passive_wait(2.1)
              lm4.setPosition(0)
              passive_wait(0.5)
              cos = 10
            
            else:
              cos = 1
          
        elif(cos == 10):
          if(checkus == 0):
            for i in range(44):
              for j in range(66):
                if(checkpoint == 0):
                  if(matrix[i][j] == 0):
                    if(i == 0 or i == 2 or i == 4 or i == 6 or i == 8 or i == 10 or i == 12 or i == 14 or i == 16 or i == 18 or i == 20 or i == 22 or i == 24 or i == 26 or i == 28 or i == 30 or i == 32 or i == 34 or i == 36 or i == 38 or i == 40 or i == 42):
                      if(matrix[i+1][j] == 0):
                        bb = i
                        rowe = j
                        checkpoint = 1
  
                    elif(i == 1 or i == 3 or i == 5 or i == 7 or i == 9 or i == 11 or i == 13 or i == 15 or i == 17 or i == 19 or i == 21 or i == 23 or i == 25 or i == 27 or i == 29 or i == 31 or i == 33 or i == 35 or i == 37 or i == 39 or i == 41 or i == 43):
                      bb = i
                      rowe = j
                      checkpoint = 1
  
                elif(checkpoint == 1):
                  print(bb, rowe, matrix[bb, rowe])
                  checkus = 1
  
          elif(checkus == 1):
            print(matrix[bb, rowe])
            print(bb, rowe)
  
            if(bb == 0 or bb == 2 or bb == 4 or bb == 6 or bb == 8 or bb == 10 or bb == 12 or bb == 14 or bb == 16 or bb == 18 or bb == 20 or bb == 22 or bb == 24 or bb == 26 or bb == 28 or bb == 30 or bb == 32 or bb == 34 or bb == 36 or bb == 38 or bb == 40 or bb == 42):             
              lm1ss = 6.3 - (1.5*rowe)
              if(bb < 21):
                  if(rowe < 24):
                    lm2s = 29.01-(2.9*(bb/2))
                  elif(rowe >= 24 and rowe < 51):
                    lm2s = 29.01-(2.9*(bb/2))-0.02
                  elif(rowe >= 51):
                    lm2s = 29.01-(2.9*(bb/2))-0.04
                  lm3s = 2.7
                  cos = 4
  
              elif(bb >= 21):
                if(rowe < 24):
                  lm2s = 29.01-(2.9*((bb-22)/2))
                elif(rowe >= 24 and rowe < 51):
                  lm2s = 29.01-(2.9*((bb-22)/2))-0.02
                elif(rowe >= 51):
                  lm2s = 29.01-(2.9*((bb-22)/2))-0.04
                lm3s = -3.37      
                cos = 4          
              
            elif(bb == 1 or bb == 3 or bb == 5 or bb == 7 or bb == 9 or bb == 11 or bb == 13 or bb == 15 or bb == 17 or bb == 19 or bb == 21 or bb == 23 or bb == 25 or bb == 27 or bb == 29 or bb == 31 or bb == 33 or bb == 35 or bb == 37 or bb == 39 or bb == 41 or bb == 43):
              lm1ss = 6.3 - (1.5*rowe)
              qw = (2*sst) + 1
              if(qw == bb and sst < 11):
                if(rowe < 24):
                  lm2s = 29.01-(2.9*sst)
                elif(rowe >= 24 and rowe < 51):
                  lm2s = 29.01-(2.9*sst)-0.02
                elif(rowe >= 51):
                  lm2s = 29.01-(2.9*sst)-0.04
  
                lm3s = 1.21
                cos = 4
                
              elif(qw == bb and sst >= 11):
                if(rowe < 24):
                  lm2s = 29.01-(2.9*(sst - 11))
                elif(rowe >= 24 and rowe < 51):
                  lm2s = 29.01-(2.9*(sst - 11))-0.02
                elif(rowe >= 51):
                  lm2s = 29.01-(2.9*(sst - 11))-0.04
  
                lm3s = -1.87
                cos = 4
              
              sst = sst + 1
                       
    
        
        elif(cos == 4):
          paps = 0
          by = 0
          passive_wait(0.5)
          lm1.setVelocity(0.43)
          lm2.setVelocity(0.9)
          lm2.setPosition(lm2s)
          passive_wait((ccou(bb)*3)+2)
          lm1.setPosition(lm1ss)
          passive_wait((rowe*3.64)+2+5.4)
          #by = (ccou(bb)*3)+2
          #paps = (rowe*3.64)+2+5.4
  
          #if(paps > by):
            #passive_wait(paps)
         # else:
           # passive_wait(by)
  
          #step12
          lm4.setPosition(0.12)
          passive_wait(3)
          #step10
          lm3.setVelocity(0.8)
          lm3.setPosition(lm3s)
          passive_wait(pasiv(bb)+5.5)
          #step11
          lm4.setPosition(0.01)
          passive_wait(3)
          #step12
          lm3.setVelocity(1)
          lm3.setPosition(-0.32)
          passive_wait(pasiv(bb)+4)
          
          matrix[bb , rowe] = 1
          
          file_path = 'matrix.txt'
          with open(file_path, 'w') as file:
            for row in matrix:
              file.write(' '.join(map(str, row)) + '\n')
  
          print(f"The matrix has been saved to {file_path}")
  
          add_location(bb, rowe, dats[5], dats[4], dats[3])
          lm4.setVelocity(1)
          lm1.setVelocity(2.5)
          lm2.setVelocity(1)
          lm4.setPosition(0)
          lm1.setPosition(8.3)
          lm2.setPosition(0.27)
          bbs = (ccou(bb)*3)+2
          rowess = rowe*0.7
  
          if(bbs > rowess):
            passive_wait(bbs)
          else:
            passive_wait(rowess)
        
          
          lm1ss = 0
          lm2s = 0
          count = 0
          check = 0
          cos = 0
          bb = 0
          rowe = 0
          cocko = 0
          checkus = 0
          checkpoint = 0
          machine()

  elif(dats[0] == "2"):  
    #take product from the rack
    print("take")
    if(bung == 0):
      matrix = read()
      bung = 1
      modet = 1
      steps = 0
      yss = 0 
      xs = 0
      values = 0
      go = 0
      ss = 0
      qw = 0
      sst = 0
      ggs = 0
      ssts = 0
      paps = 0
      lm11s = 0
      lm22s = 0
      bipa = 0
      stub = 0
      cam = 0
      cinc = 0
      distance = {}
      checku = 0
      min_dis = 1000000000
      x = dats[2]
      y = dats[1]
  
    while supervisor.step(TIME_STEP) != -1:
      if receiver.getQueueLength() > 0:
        print('stop1')
        modet = 1
        go = 0
        steps = 0
        yss = 0
        xs = 0
        ys = 0
        cinc = 0
        checku = 0
        min_dis = 1000000000
        return
      
      if(modet == 1):
        machine()
        print(x, y, matrix[y,x])
        if(matrix[y,x] == 1):
          if(y == 1 or y == 3 or y == 5 or y == 7 or y == 9 or y == 11 or y == 13 or y == 15 or y == 17 or y == 19 or y == 21 or y == 23 or y == 25 or y == 27 or y == 29 or y == 31 or y == 33 or y == 35 or y == 37 or y == 39 or y == 41 or y == 43):
            lm1ss = 6.3 - (1.5*x)
            lm11s = lm1ss
            qw = (2*sst)+1
            if(qw == y and sst < 11):
              if(x < 24):
                lm2s = 29.01-(2.9*sst)
              elif(x >= 24 and x < 51):
                lm2s = 29.01-(2.9*sst)-0.02
              elif(x >= 51):
                lm2s = 29.01-(2.9*sst)-0.04
  
              lm22s = lm2s
              lm3s = 1.21
              move1(lm1ss, lm2s)
              ggs = forcount1(sst+1)
              if(cinc == 0):
                passive_wait(countab(forcount1(sst+1), x*0.7))
              modet = 2
              go = 2
              
            elif(qw == y and sst >= 11):
              if(x < 24):
                lm2s = 29.01-(2.9*(sst - 11))
              elif(x >= 24 and x < 51):
                lm2s = 29.01-(2.9*(sst - 11))-0.02
              elif(x >= 51):
                lm2s = 29.01-(2.9*(sst - 11))-0.04
  
              lm22s = lm2s
              lm3s = -1.87
              move1(lm1ss, lm2s)
              
              ggs = forcount1(sst+1)
              if(cinc == 0):
                passive_wait(countab(forcount1(sst+1), x*0.7))
              modet = 2
              go = 2
  
            sst = sst + 1
  
          elif(y == 0 or y == 2 or y == 4 or y == 6 or y == 8 or y == 10 or y == 12 or y == 14 or y == 16 or y == 18 or y == 20 or y == 22 or y == 24 or y == 26 or y == 28 or y == 30 or y == 32 or y == 34 or y == 36 or y == 38 or y == 40 or y == 42): 
            if(go == 0):
              if(matrix[y, x] == 1):
                lm1ss = 6.3 - (1.5*x)
                lm11s = lm1ss
                if(y < 21):
                  if(x < 24):
                    lm2s = 29.01-(2.9*(y/2))
                  elif(x >= 24 and x < 51):
                    lm2s = 29.01-(2.9*(y/2))-0.02
                  elif(x >= 51):
                    lm2s = 29.01-(2.9*(y/2))-0.04
  
                  lm22s = lm2s
                  lm3s = 2.7
  
                elif(y >= 21):
                  if(x < 24):
                    lm2s = 29.01-(2.9*((y-22)/2))
                  elif(x >= 24 and x < 51):
                    lm2s = 29.01-(2.9*((y-22)/2))-0.02
                  elif(x >= 51):
                    lm2s = 29.01-(2.9*((y-22)/2))-0.04
  
                  lm22s = lm2s
                  lm3s = -3.37
                move1(lm1ss, lm2s)
  
                if(x == 0):
                  ggs = forcount(y)
                  st = countab(forcount(y), x*0.7)
                  if(yss == 0):
                    if(cinc == 0):
                      passive_wait(st)
                  if(matrix[y+1, x] == 0):
                    go = 2 
                  elif(matrix[y+1, x] == 1):
                    ys = y + 1
                    yr = ys
                    xr = x
                    lm3s = lm3go(ys)                  
                    go = 3
                
  
                elif(x > 0):
                  ggs = forcount(y)
                  st = countab(forcount(y), x*0.7)
                  if(yss == 0):
                    if(cinc == 0):
                      passive_wait(st)
                  if(matrix[y+1, x] == 0):
                    go = 2 
                  elif(matrix[y+1, x] == 1):
                    ys = y + 1
                    lm3s = lm3go(ys)
                    yr = ys
                    xr = x
                    go = 3
                modet = 2          
    
      elif(modet == 2):
        if(go == 2):
          if(steps == 0):
            if(y == 1 or y == 3 or y == 5 or y == 7 or y == 9 or y == 11 or y == 13 or y == 15 or y == 17 or y == 19 or y == 21):
              values = lidar_search()
              cam = 0
            elif(y == 23 or y == 25 or y == 27 or y == 29 or y == 31 or y == 33 or y == 35 or y == 37 or y == 39 or y == 41 or y == 43):
              values = lidar_searchs() 
              cam = 1
            elif(y == 0 or y == 2 or y == 4 or y == 6 or y == 8 or y == 10 or y == 12 or y == 14 or y == 16 or y == 18 or y == 20):  
              values = lidar_search1()
              cam = 0
            elif(y == 22 or y == 24 or y == 26 or y == 28 or y == 30 or y == 32 or y == 34 or y == 36 or y == 38 or y == 40 or y == 42):
              values = lidar_searchs1()
              cam = 1
  
            if(values > 1):
              machine1()
              if(cam == 0):
                lm3.setVelocity(4)
                lm3.setPosition(lm3s - 1.7)
                passive_wait(pasiv(y))
                binggg = qrcode1()
                passive_wait(1)
              elif(cam == 1):
                lm3.setVelocity(4)
                lm3.setPosition(lm3s + 1.7)
                passive_wait(pasiv(y))
                binggg = qrcode1s()
                passive_wait(1)
  
              if(binggg == dats[6]):
                lm4.setPosition(0.001)
                lm3.setVelocity(4)
                lm3.setPosition(lm3s)
                steps = 2
              elif(not(binggg == dats[6])):
                print("The product name not same!")
                while not(binggg == dats[6]):
                  if(cam == 0):
                    binggg = qrcode1()
                    passive_wait(1)
                  elif(cam == 1):
                    binggg = qrcode1s()
                    passive_wait(1)
                  

  
          elif(steps == 2):
            passive_wait(pasiv(y))
            lm4.setVelocity(0.5)
            lm4.setPosition(0.16)
            passive_wait(1)
            #step5
            lm3.setVelocity(1)
            lm3.setPosition(-0.32)
            passive_wait(pasiv(y) + 4)
            #step6
            lm4.setVelocity(0.3)
            lm4.setPosition(0)
            passive_wait(1)
            #step7
            lm2.setVelocity(0.9)
            lm2.setPosition(0.27)
            passive_wait(ggs)
            lm1.setVelocity(0.42)
            lm1.setPosition(8.3)
            passive = 18
            passive_wait((5.4+(x*3.64))+2)
            steps = 2.1
            go = 2.1
            #step9
  
        elif(go == 2.1):  
          if(steps == 2.1):
            if(ds_checker.getValue() == 1000):
              steps = 2.2
  
          elif(steps == 2.2):
            lm4.setPosition(0.086)
            passive_wait(3)
            #step10
            lm3.setPosition(-1.967)
            passive_wait(3.4)
            #step11
            lm4.setPosition(0.041)
            passive_wait(3)
            #step12
            lm3.setPosition(-0.32)
            passive_wait(4)
            lm4.setPosition(0)
            matrix[y, x] = 0

            change_flag(dats)
            file_path = "matrix.txt"
            with open(file_path, 'w') as file:
              for row in matrix:
                file.write(' '.join(map(str, row)) + '\n')
  
            print(f"The matrix has been saved to {file_path}") 
            go = 4            
        
        #if storage being blocked
        elif(go == 3):
          if(steps == 0):
            if(ys == 1 or ys == 3 or ys == 5 or ys == 7 or ys == 9 or ys == 11 or ys == 13 or ys == 15 or ys == 17 or ys == 19 or ys == 21):
              values = lidar_search()
              cam = 0
            elif(ys == 23 or ys == 25 or ys == 27 or ys == 29 or ys == 31 or ys == 33 or ys == 35 or ys == 37 or ys == 39 or ys == 41 or ys == 43):
              values = lidar_searchs() 
              cam = 1
            elif(ys == 0 or ys == 2 or ys == 4 or ys == 6 or ys == 8 or ys == 10 or ys == 12 or ys == 14 or ys == 16 or ys == 18 or ys == 20):  
              values = lidar_search1()
              cam = 0
            elif(ys == 22 or ys == 24 or ys == 26 or ys == 28 or ys == 30 or ys == 32 or ys == 34 or ys == 36 or ys == 38 or ys == 40 or ys == 42):
              values = lidar_searchs1()
              cam = 1
  
            if(values > 1):
              machine1()
              if(cam == 0):
                lm3.setVelocity(4)
                lm3.setPosition(lm3s - 1.7)
                passive_wait(pasiv(ys))
                binggg = qrcode1()
                passive_wait(1)
  
              elif(cam == 1):
                lm3.setVelocity(4)
                lm3.setPosition(lm3s + 1.7)
                passive_wait(pasiv(ys))
                binggg = qrcode1s()
                passive_wait(1)

              productname = check_productname(dats[1]+1, dats[2], dats[3])
              if(binggg == productname[0]):
                lm3.setVelocity(4)
                lm3.setPosition(lm3s)
                passive_wait(pasiv(ys))
                steps = 2
              elif(not(binggg == productname[0])):
                steps = 0
                print("The product name not same!")
          
        
          elif(steps == 2):
            lm4.setVelocity(0.5)
            lm4.setPosition(0.16)
            passive_wait(1)
            #step5
            lm3.setVelocity(1)
            lm3.setPosition(-0.32)
            passive_wait(pasiv(ys) + 4)
            #step6
            lm4.setPosition(0)
            passive_wait(1)
            steps = 3
          
          elif(steps == 3):
            if(checku == 0):
              for i in range(44):
                for j in range(66):
                  print('bog')
                  zack = not(i == y and j == x)
                  zack1 = not(i == ys and j == x)
                  zack2 = not(i+1 == y and j == x)
                  zack3 = not(i+1 == ys and j == x)
                  if(zack or zack1):
                    if(matrix[i][j] == 0):
                      if(i == 0 or i == 2 or i == 4 or i == 6 or i == 8 or i == 10 or i == 12 or i == 14 or i == 16 or i == 18 or i == 20 or i == 22 or i == 24 or i == 26 or i == 28 or i == 30 or i == 32 or i == 34 or i == 36 or i == 38 or i == 40 or i == 42):
                        if(matrix[i+1][j] == 0 and (zack2 and zack3)):
                          if(i <= 21):
                            distance[i, j]= abs((i+1) - ys) + abs(j - x)
                          elif(i > 21):
                            distance[i, j]= abs((i-21) - ys) + abs(j - x)
  
                        elif(matrix[i+1][j] == 1 or (not zack2 or not zack3)):
                          distance[i, j]= float('inf')
  
                      elif(i == 1 or i == 3 or i == 5 or i == 7 or i == 9 or i == 11 or i == 13 or i == 15 or i == 17 or i == 19 or i == 21 or i == 23 or i == 25 or i == 27 or i == 29 or i == 31 or i == 33 or i == 35 or i == 37 or i == 39 or i == 41 or i == 43):
                        if(i <= 21):
                          distance[i, j]= abs(i - ys) + abs(j - x)
                        elif(i > 21):
                          distance[i, j]= abs((i-22) - ys) + abs(j - x)
  
                    else:
                      distance[i, j]= float('inf')
                  
                  else:
                    distance[i,j]= float('inf')
  
                  print(matrix[i, j], distance[i, j], i, j)
  
              checku = 1
  
            elif(checku == 1):
              for k in range(44):
                for l in range(66):
                  if (distance[k, l] < min_dis):
                    min_dis = distance[k,l]
                    yss = k
                    xs = l 
  
                  print(distance[k, l], yss, xs, min_dis)  
              checku = 2
  
            elif(checku == 2): 
              if(yss == 0 or yss == 2 or yss == 4 or yss == 6 or yss == 8 or yss == 10 or yss == 12 or yss == 14 or yss == 16 or yss == 18 or yss == 20 or yss == 22 or yss == 24 or yss == 26 or yss == 28 or yss == 30 or yss == 32 or yss == 34 or yss == 36 or yss == 38 or yss == 40 or yss == 42):
                if(yss == 0 or yss == 2 or yss == 4 or yss == 6 or yss == 8 or yss == 10 or yss == 12 or yss == 14 or yss == 16 or yss == 18 or yss == 20):
                  lm1ss = 6.3 - (1.5*xs)
                  if(xs < 24):
                    lm2s = 29.01-(2.9*(yss/2))
                  elif(xs >= 24 and xs < 51):
                    lm2s = 29.01-(2.9*(yss/2))-0.02
                  elif(xs >= 51):
                    lm2s = 29.01-(2.9*(yss/2))-0.04
                  lm3s = 2.7
                  steps = 4
                     
                elif(yss == 22 or yss == 24 or yss == 26 or yss == 28 or yss == 30 or yss == 32 or yss == 34 or yss == 36 or yss == 38 or yss == 40 or yss == 42):
                  lm1ss = 6.3 - (1.5*xs)
                  if(xs < 24):
                    lm2s = 29.01-(2.9*((yss-22)/2))
                  elif(xs >= 24 and xs < 51):
                    lm2s = 29.01-(2.9*((yss-22)/2))-0.02
                  elif(xs >= 51):
                    lm2s = 29.01-(2.9*((yss-22)/2))-0.04
  
                  lm3s = -3.37
                  steps = 4
  
              elif(yss == 1 or yss == 3 or yss == 5 or yss == 7 or yss == 9 or yss == 11 or yss == 13 or yss == 15 or yss == 17 or yss == 19 or yss == 21 or yss == 23 or yss == 25 or yss == 27 or yss == 29 or yss == 31 or yss == 33 or yss == 35 or yss == 37 or yss == 39 or yss == 41 or yss == 43):
                lm1ss = 6.3 - (1.5*xs)
                qw = (2*ssts) + 1
                if(qw == yss and ssts < 11):
                  if(xs < 24):
                    lm2s = 29.01-(2.9*ssts)
                  elif(xs >= 24 and xs < 51):
                    lm2s = 29.01-(2.9*ssts)-0.02
                  elif(xs >= 51):
                    lm2s = 29.01-(2.9*ssts)-0.04 
                  lm3s = 1.21
                  steps = 4
          
                elif(qw == yss and ssts >= 11):
                  if(xs < 24):
                    lm2s = 29.01-(2.9*(ssts - 11))
                  elif(xs >= 24 and xs < 51):
                    lm2s = 29.01-(2.9*(ssts - 11))-0.02
                  elif(xs >= 51):
                    lm2s = 29.01-(2.9*(ssts - 11))-0.04
                  lm3s = -1.87
                  steps = 4
                ssts = ssts + 1 
  
  
          elif(steps == 4): 
            lm1.setVelocity(0.4)
            lm1.setPosition(lm1ss)
            by = ccou(yss)
            byy = ccou(ys)
  
            if(x > xs):
              bab = x-xs
              paps = ((x-xs)*3.64)+2+1.76
            elif(x < xs):
              bab = xs-x
              paps = ((xs-x)*3.64)+2+1.76
            else:
              bab = 0
              paps = 1
  
            passive_wait(paps+2)
            
            lm2.setPosition(0.9)
            lm2.setPosition(lm2s)
            if(by > byy):
              passive_wait(((by-byy)*3)+2)
              if( paps > (((by-byy)*3)+2)):
                bipa = paps
              else:
                bipa = ((by-byy)*3)+2
              steps = 5
  
            elif(by < byy):
              passive_wait(((byy-by)*3)+2)
              if( paps > (((byy-by)*3)+2)):
                bipa = paps
              else:
                bipa = ((byy-by)*3)+3
              steps = 5
  
            elif(by == byy):
              passive_wait(1)
              bipa = paps
              steps = 5
  
  
  
          elif(steps == 5):
            #step12
            lm4.setPosition(0.12)
            passive_wait(1.5)
            #step10
            lm3.setPosition(lm3s)
            passive_wait(pasiv(yss)+4)
            #step11
            lm4.setPosition(0.01)
            passive_wait(1.5)
            #step12
            lm3.setPosition(-0.32)
            passive_wait(pasiv(yss)+4)
  
            move1(lm11s, lm22s)
  
            if(ccou(ys) > ccou(yss)):
              chin = (ccou(ys)-ccou(yss))*3
              if(bab*0.7 > chin):
                passive_wait(bab*0.7+1)
              else:
                passive_wait(chin)
  
            elif(ccou(ys) < ccou(yss)):
              chin = (ccou(yss)-ccou(ys))*3
              if(bab*0.7 > chin):
                passive_wait(bab*0.7+1)
              else:
                passive_wait(chin)
  
            elif(ccou(ys) == ccou(yss)):
              passive_wait(bab*0.7+1)
  
  
  
          
            matrix[yss, xs] = 1
            matrix[ys, x] = 0

            change_flag(dats)
            change_location(productname[1], dats[1]+1, dats[2], "1")
            file_path = "matrix.txt"
            with open(file_path, 'w') as file:
              for row in matrix:
                file.write(' '.join(map(str, row)) + '\n')
  
            print(f"The matrix has been saved to {file_path}")

  
            modet = 1
            go = 0
            steps = 0
            yss = 0
            xs = 0
            ys = 0
            ssts = 0
            sst = 0
            cinc =1
            checku = 0
            min_dis = 1000000000
            machine()