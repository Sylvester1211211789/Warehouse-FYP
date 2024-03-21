from controller import Supervisor, Keyboard
import mysql.connector
import datetime
import qrcode
import os
import cv2
from datetime import datetime
import numpy as np
import random

supervisor = Supervisor()
keyboard = Keyboard()
TIME_STEP = 64

speed = 0
turn = 0
lin = 0
li = supervisor.getDevice('linear')

#access 4 wheels
w1 = supervisor.getDevice('wheel1')
w2 = supervisor.getDevice('wheel2')
w1t = supervisor.getDevice('wheel1t')
w2t = supervisor.getDevice('wheel2t')
w3 = supervisor.getDevice('wheel3')
w4 = supervisor.getDevice('wheel4')
w1t.setPosition(float('inf'))
w2t.setPosition(float('inf'))
w3.setPosition(float('inf'))
w4.setPosition(float('inf'))

lidar = supervisor.getDevice('lidars')
lidar.enable(TIME_STEP)

gps = supervisor.getDevice('gps')
gps.enable(TIME_STEP)

camera = supervisor.getDevice('camera')
camera.enable(TIME_STEP)

forklift = supervisor.getFromDef('FORKLIFT')

def write_product_info(id, product, weight, height):
  current_directory = os.getcwd()
  project_directory = os.path.dirname(os.path.dirname(current_directory))
  worlds_dir = os.path.join(project_directory, 'controllers/my_pout')
  file_name = 'pallet_system.txt'
  file_path = os.path.join(worlds_dir, file_name)
  
  # Write some text to the file
  with open(file_path, "w") as file:
      file.write(str(id) + ", " + str(product) + ", " + str(weight) + ", " + str(height))
  print(f"File saved at: {file_path}")
  return

def generate_qr(id, product):
    name = product+"_"+str(id)
    current_directory = os.getcwd()
    project_directory = os.path.dirname(os.path.dirname(current_directory))
    worlds_dir = os.path.join(project_directory, 'worlds')

    qr = qrcode.QRCode(
        version=1,
        error_correction=qrcode.constants.ERROR_CORRECT_L,
        box_size=10,
        border=4,
    )

    data = name
    dat = name + ".png"
    qr.add_data(data)
    qr.make(fit=True)
    img = qr.make_image(fill_color="black", back_color="white")
    file_path = os.path.join(worlds_dir, dat)
    img.save(file_path)
    print(f"QR code image saved to: {file_path}")

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

    #mycursor.execute("SELECT task.Date, task.Time, product.Product_Name, task.TaskID FROM task inner join product on task.ProductID = product.ProductID where PS_check = '0' and Action = 'Store' and AGV_check = '0' and SC_check = '0' and Forklift_check = '1'")
    mycursor.execute("SELECT task.Date, task.Time, product.Product_Name, task.TaskID, task.ProductID FROM task inner join product on task.ProductID = product.ProductID where PS_check = '0' and Action = 'Store' and AGV_check = '0' and SC_check = '0' and Forklift_check = '0'")

    myresult = mycursor.fetchall()
    if myresult != []:
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

    #mycursor.execute("SELECT task.Date, task.Time, product.Product_Name, task.TaskID, task.Sku  FROM task inner join product on task.ProductID = product.ProductID where PS_check = '0' and Action = 'Retrieve' and AGV_check = '1' and SC_check = '1' and Forklift_check = '0'")
    mycursor.execute("SELECT task.Date, task.Time, product.Product_Name, task.TaskID, task.Sku  FROM task inner join product on task.ProductID = product.ProductID where PS_check = '1' and Action = 'Retrieve' and AGV_check = '1' and SC_check = '1' and Forklift_check = '0'")

    myresult1 = mycursor.fetchall()
    print(myresult1)

    if not myresult1:
      print("ok")
      print(myresult1)
    else:
      print('hallo')
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
        data=["1", myresult[min][3], myresult[min][2], myresult[min][4]]
        return data
      else:
        print("Outbound has been selected")
        print(myresult1[min1])
        data=["2", myresult1[min1][3], myresult1[min1][2], myresult1[min1][4]]
        return data

        
    elif(checkpoint == 1 and checkpoint1 == 0):
      datetime1 = datetime.strptime(time, date_time_format)
      print(datetime1)
      print(myresult[min])
      print("Inbound has been selected")
      data=["1", myresult[min][3], myresult[min][2], myresult[min][4]]
      return data
      
    elif(checkpoint1 == 1 and checkpoint == 0):
      datetime2 = datetime.strptime(time1, date_time_format)
      print(datetime2)
      print(myresult1[min1])
      print("Outbound has been selected")
      data=["2", myresult1[min1][3], myresult1[min1][2], myresult1[min1][4]]
      return data

def outbound_database():
  date_time_format = "%Y-%m-%d %H:%M:%S"
  mydb = sql()
  mycursor = mydb.cursor()
  mycursor.execute("SELECT task.Date, task.Time, product.Product_Name, task.TaskID, task.Sku  FROM task inner join product on task.ProductID = product.ProductID where PS_check = '0' and Action = 'Retrieve' and AGV_check = '1' and SC_check = '1' and Forklift_check = '0'")
  myresult1 = mycursor.fetchall()
  print(myresult1)
  if not myresult1:
      print("Don't have task for outbound")

  else:
    count1 = 0
    min1 = 0
    time1 = str(myresult1[0][0]) + " " + str(myresult1[0][1])
    datetime2 = datetime.strptime(time1, date_time_format)
    for x in myresult1:
      time1 = str(x[0]) + " " + str(x[1])
      if(datetime2 > datetime.strptime(time1, date_time_format)):
        min1 = count1
      count1 = count1 + 1

    data = [myresult1[min1][3], myresult1[min1][2], myresult1[min1][4]]
    return data

def inbound_database():
    date_time_format = "%Y-%m-%d %H:%M:%S"
    mydb = sql()
    mycursor = mydb.cursor()

    mycursor.execute("SELECT task.Date, task.Time, product.Product_Name, task.TaskID FROM task inner join product on task.ProductID = product.ProductID where PS_check = '0' and Action = 'Store' and AGV_check = '0' and SC_check = '0' and Forklift_check = '1'")

    myresult = mycursor.fetchall()
    if myresult != []:
      count  = 0
      min = 0
      time = str(myresult[0][0]) + " " + str(myresult[0][1])
      datetime1 = datetime.strptime(time, date_time_format)
      for x in myresult:
        time = str(x[0]) + " " + str(x[1])
        if(datetime1 > datetime.strptime(time, date_time_format)):
          min = count
        count= count + 1
      
      data = [myresult[min][3], myresult[min][2]]
      return data

    
def good():
  num_children = forklift.getField('children').getCount()
  for i in range(num_children):
    child = forklift.getField('children').getMFNode(i)
    man1 = child.getDef()
    if(man1 == "wheel1"):
      man = supervisor.getFromDef(man1)
      man2 = man.getField('endPoint').getSFNode()
      man2.getField('translation').setSFVec3f([-0.67, 0.43, -0.01])
      print(man2)
    elif(man1 == "wheel2"):
      man = supervisor.getFromDef(man1)
      man2 = man.getField('endPoint').getSFNode()
      man2.getField('translation').setSFVec3f([-0.67, -0.43, -0.01])
      print(man2)
    elif(man1 == "wheel3"):
      man = supervisor.getFromDef(man1)
      man2 = man.getField('endPoint').getSFNode()
      man2.getField('translation').setSFVec3f([0.67, 0.43, -0.01])
      print(man2)
    elif(man1 == "wheel4"):
      man = supervisor.getFromDef(man1)
      man2 = man.getField('endPoint').getSFNode()
      man2.getField('translation').setSFVec3f([0.67, -0.43, -0.01])
      print(man2)

def pall(id, product):
   namw = product+"_"+str(id)
   nas = namw+".png"
   print(nas)
   fork = forklift.getField('children')
   original_object = supervisor.getFromDef('palle12')
   object_string = original_object.exportString()
   object_name = 'palle12'
   unique_object_name = namw
   object_strings = object_string.replace(object_name, unique_object_name)
   object_string_with_texture = object_strings.replace(
        'DEF qr1 Pose {',
        'DEF qr1 Pose { children [ Shape { translation -0.404 -0.01 -0.01 rotation 0 0 1 0 appearance Appearance { texture ImageTexture { url '+'"'+ nas +'"'+' } } geometry Box { size 0.006 0.1 0.1 } } ]'
        )
   object_string_with_texture1 = object_string_with_texture.replace(
        'DEF qr2 Pose {',
        'DEF qr2 Pose { children [ Shape { translation 0.403 -0.01 -0.01 rotation 0 0 1 0 appearance Appearance { texture ImageTexture { url '+'"'+ nas +'"'+' } } geometry Box { size 0.006 0.1 0.1 } } ]'
        )

   fork.importMFNodeFromString(4, object_string_with_texture1)
   
   num_children = forklift.getField('children').getCount()
   for i in range(num_children):
    child = forklift.getField('children').getMFNode(i)
    man1 = child.getDef()
    if(man1 == namw):
      man = supervisor.getFromDef(man1)
      man.getField('translation').setSFVec3f([-1.63549, 0.00165831, -0.0618451])
      man2 = man.getField('children').getCount()
      for i in range(man2):
        childs = man.getField('children').getMFNode(i)
        man3 = childs.getDef()
        print(man3)
        if(man3 == "Box"):
          #set mass
          total_weight_limit = 1000 
          size = supervisor.getFromDef(man3).getField("boundingObject").getSFNode().getField('size').getSFVec3f()
          volume = size[0]*size[1]*size[2]
          num = total_weight_limit/volume
          number = random.randint(1, 100)
          print(number)
          supervisor.getFromDef(man3).getField("physics").getSFNode().getField('mass').setSFFloat(float(number))
            
                       
def remove_obj(id, product):
    name = product+"_"+str(id)
    num_children = forklift.getField('children').getCount()
    for i in range(num_children):
        child = forklift.getField('children').getMFNode(i)
        man1 = child.getDef()
        if man1 == name:
            object_to_remove = supervisor.getFromDef(man1)
            object_string = object_to_remove.exportString()
            object_to_remove.remove()
            rootNode = supervisor.getRoot()
            rootChildrenField = rootNode.getField('children')
            rootChildrenField.importMFNodeFromString(4, object_string)
            objectt = supervisor.getFromDef(man1)
            objectt.getField('translation').setSFVec3f([5.79656, 3.35407, 0.577911])
            return

def remove_obj1(content):
    name = content
    getpall = supervisor.getFromDef(name)
    object_string = getpall.exportString()
    fork = forklift.getField('children')
    fork.importMFNodeFromString(4, object_string)
    getpall.remove()
    num_children = forklift.getField('children').getCount()
    for i in range(num_children):
      child = forklift.getField('children').getMFNode(i)
      man1 = child.getDef()
      if(man1 == name):
        man = supervisor.getFromDef(man1)
        man.getField('translation').setSFVec3f([-1.63549, 0.00165831, -0.0618451])
        man.resetPhysics()

def remove_obj2(content):
    name = content
    print(name)
    num_children = forklift.getField('children').getCount()
    for i in range(num_children):
      child = forklift.getField('children').getMFNode(i)
      man1 = child.getDef()
      if(man1 == name):
        man = supervisor.getFromDef(man1)
        man.remove()
        return
        
def speedo(s1, s2, s3, s4):
  w1t.setVelocity(s1)
  w2t.setVelocity(s2)
  w3.setVelocity(s3)
  w4.setVelocity(s4)

speedo(0,0,0,0)
def step():
  if (supervisor.step(TIME_STEP) == -1):
    supervisor.stepEnd()

def passive_wait(sec):
  start_time = supervisor.getTime()
  print(start_time)
  while (start_time + sec > supervisor.getTime()):
    step()

def scanqr(productname):
  image = camera.getImage()
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
      parts = bingss.split('_')
      if(productname == parts[0]):
        return 1
      else:
        return 0
  
def scan():
  image = camera.getImage()
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
      return(bingss)

def Forklift_check(taskid):
  mydb = sql()
  mycursor = mydb.cursor()
  sqls = "update task set Forklift_check = '1' where TaskID = %s"
  val = (taskid, )
  mycursor.execute(sqls, val)
  mydb.commit()

checkpoint = 0
con = 0
transla = -2.71827
#3.33772
while supervisor.step(TIME_STEP) != -1:
  if(checkpoint == 0):
    data = checking_database()

    if((data != []) and (data != None)):
      height = random.uniform(0.1, 0.8)
      weight = random.randint(1, 100)
      check = 0
      checkpoint = 1
      

  elif(checkpoint == 1):
    pos = gps.getValues()
    print(pos)

    if(round(pos[1],2) != 3.34 or round(pos[2],2) != 0.74):
      forklift.getField('translation').setSFVec3f([pos[0], transla, 0.74])

    if(data[0] == '1'):
      if(check == 0):
        gm = forklift.getField('rotation').getSFRotation()
        print(gm)
        if(not(round(pos[0],2) >= 19.57)):
          print('ggggg')
          if(not(round(gm[3],2) >= 3.00 and round(gm[3],2) <= 3.25)):
            print('kkkkkkkk')
            forklift.getField('rotation').setSFRotation([0, 0, 1, 3.14159])
            good()
            check = 1
          else:
            good()
            check = 1
      
        else:
          forklift.getField('rotation').setSFRotation([0, 0, 1, 0])
          check = 1

      elif(check == 1):
        speedo(-5,-5,-5,-5)
        if(round(pos[0],2) >= 19.57):
          speedo(0,0,0,0)
          forklift.getField('rotation').setSFRotation([0, 0, 1, 0])
          #generate_qr(data[4], data[3], data[5])
          write_product_info(data[1], data[3], weight, height)
          generate_qr(data[1], data[2])
          good()
          pall(data[1], data[2])
          passive_wait(1)
          speedo(-5,-5,-5,-5)
          passive_wait(0.4)
          check = 2

      elif(check == 2):
        if(round(pos[0],2) <= 8.87):
          Forklift_check(data[1])
          speedo(0,0,0,0)
          count = 0
          lidar_value = lidar.getRangeImage()
          lidar_va = np.array(lidar_value)
          count = np.sum(lidar_va < 2.0)
          if(count > 200):
            passive_wait(0.5)
            remove_obj(data[1], data[2])
            forklift.resetPhysics()
            passive_wait(0.5)
            forklift.getField('rotation').setSFRotation([0, 0, 1, 0])
            passive_wait(1)
            forklift.getField('rotation').setSFRotation([0, 0, 1, 3.14159])
            passive_wait(1)
            good()
            speedo(-5,-5,-5,-5)
            passive_wait(0.4)
            check = 3
        
      elif(check == 3):
        if(round(pos[0],2) >= 19.57):
          speedo(0,0,0,0)
          check = 0
          checkpoint = 0

    elif(data[0] == '2'):
      if(round(pos[1],2) != 3.34 or round(pos[2],2) != 0.74):
        forklift.getField('translation').setSFVec3f([pos[0], transla, 0.74])

      if(check == 0):
        gm = forklift.getField('rotation').getSFRotation()
        print(gm)
        if(not(round(pos[0],2) >= 19.57)):
          print('ggggg')
          if(not(round(gm[3],2) >= -0.5 and round(gm[3],2) <= 0.5)):
            print('kkkkkkkk')
            forklift.getField('rotation').setSFRotation([0, 0, 1, 0])
            good()
            check = 1
          else:
            good()
            check = 1
      
        else:
          forklift.getField('rotation').setSFRotation([0, 0, 1, 0])
          check = 1

      elif(check == 1):
        #passive_wait(0.3)
        good()
        #li.setVelocity(5)
        #li.setPosition(-0.188)
        passive_wait(0.4)
        speedo(-5,-5,-5,-5)
        check = 2

      elif(check == 2):
         
         #7.55
         if(round(pos[0],2) <= 8.87):
          speedo(0,0,0,0)
          co = scanqr(data[2])
          if(co == 1):
            cont = scan()
            print(cont)
            #li.setPosition(0.03)
            remove_obj1(cont)
            passive_wait(0.5)
            forklift.getField('translation').setSFVec3f([pos[0], transla, 0.74])            
            forklift.getField('rotation').setSFRotation([0, 0, 1, 3.14159])
            good()
            passive_wait(0.5)
            speedo(-5,-5,-5,-5)
            check = 3
          else:
            print('not same')

      elif(check == 3):
        if(round(pos[0],2) >= 19.57):
          speedo(0,0,0,0)
          remove_obj2(cont)
          forklift.resetPhysics()
          good()
          Forklift_check(data[1])
          check = 0
          checkpoint = 0
  
  
  #speedo(-3,-3,-3,-3)
  #if(round(pos[0],1) == 7.7 and round(pos[1],1) == 3.3 and round(pos[2],2) == 0.53):
   # forklift.getField('rotation').setSFRotation([0, 0, 1, 3.14159])
   # forklift.getField('translation').setSFVec3f([7.6089, 3.33772, 0.54939])
    
  #elif(round(pos[0],1) == 17.6 and round(pos[1],1) == 3.4 and round(pos[2],2) == 0.53):
   # forklift.getField('rotation').setSFRotation([0, 0, 1, 0])
   # forklift.getField('translation').setSFVec3f([20.7689, 3.33772, 0.54939])
