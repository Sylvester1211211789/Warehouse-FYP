from controller import Supervisor
import threading
import multiprocessing
import logging
import asyncio
import time
import mysql.connector
from datetime import datetime
import qrcode
import os
import numpy as np
import cv2

supervisor = Supervisor()

timestep = int(supervisor.getBasicTimeStep())

logging.basicConfig()
logger = logging.getLogger(__name__)
logger.setLevel('INFO')

receiver = supervisor.getDevice('receiver')
receiver.enable(timestep)

bi = supervisor.getDevice('bi')
bi.setPosition(float('inf'))
bi1 = supervisor.getDevice('bi1')
bi1.setPosition(float('inf'))
bi2 = supervisor.getDevice('bi2')
bi2.setPosition(float('inf'))
bi3 = supervisor.getDevice('bi3')
bi3.setPosition(float('inf'))
bo2s = supervisor.getDevice('bo2s')
bo2s.setPosition(float('inf'))
bo3s = supervisor.getDevice('bo3s')
bo3s.setPosition(float('inf'))
turn = supervisor.getDevice('turn')
turn.setPosition(float('inf'))
turn1 = supervisor.getDevice('turn1')
turn1.setPosition(float('inf'))
turn2 = supervisor.getDevice('turn2')
turn2.setPosition(float('inf'))
turn1s = supervisor.getDevice('turn1s')
turn1s.setPosition(float('inf'))
turn2s = supervisor.getDevice('turn2s')
turn2s.setPosition(float('inf'))
bo = supervisor.getDevice('bo')
bo.setPosition(float('inf'))
bo1 = supervisor.getDevice('bo1')
bo1.setPosition(float('inf'))
bo2 = supervisor.getDevice('bo2')
bo2.setPosition(float('inf'))
bo3 = supervisor.getDevice('bo3')
bo3.setPosition(float('inf'))
bo13 = supervisor.getDevice('bo13')
bo13.setPosition(float('inf'))
bo14 = supervisor.getDevice('bo14')
bo14.setPosition(float('inf'))
bo17 = supervisor.getDevice('bo17')
bo17.setPosition(float('inf'))
bo12 = supervisor.getDevice('bo12')
bo12.setPosition(float('inf'))
bo15 = supervisor.getDevice('bo15')
bo15.setPosition(float('inf'))
bo16 = supervisor.getDevice('bo16')
bo16.setPosition(float('inf'))
bo2s = supervisor.getDevice('bo2s')
bo2s.setPosition(float('inf'))
bo3s = supervisor.getDevice('bo3s')
bo3s.setPosition(float('inf'))
bo16s = supervisor.getDevice('b16s')
bo16s.setPosition(float('inf'))
bo17s = supervisor.getDevice('b17s')
bo17s.setPosition(float('inf'))

m1s = supervisor.getDevice('m1s')
m1s.setPosition(float('inf'))
m2s = supervisor.getDevice('m2s')
m2s.setPosition(float('inf'))
m3s = supervisor.getDevice('m3s')
m3s.setPosition(float('inf'))
m4s = supervisor.getDevice('m4s')
m4s.setPosition(float('inf'))
m5s = supervisor.getDevice('m5s')
m5s.setPosition(float('inf'))
m6s = supervisor.getDevice('m6s')
m6s.setPosition(float('inf'))
m7s = supervisor.getDevice('m7s')
m7s.setPosition(float('inf'))
m8s = supervisor.getDevice('m8s')
m8s.setPosition(float('inf'))
m9s = supervisor.getDevice('m9s')
m9s.setPosition(float('inf'))
m10s = supervisor.getDevice('m10s')
m10s.setPosition(float('inf'))
m1 = supervisor.getDevice('m1')
m1.setPosition(float('inf'))
m2 = supervisor.getDevice('m2')
m2.setPosition(float('inf'))
m3 = supervisor.getDevice('m3')
m3.setPosition(float('inf'))
m4 = supervisor.getDevice('m4')
m4.setPosition(float('inf'))
m5 = supervisor.getDevice('m5')
m5.setPosition(float('inf'))
m6 = supervisor.getDevice('m6')
m6.setPosition(float('inf'))
m7 = supervisor.getDevice('m7')
m7.setPosition(float('inf'))
m8 = supervisor.getDevice('m8')
m8.setPosition(float('inf'))
m9 = supervisor.getDevice('m9')
m9.setPosition(float('inf'))
m10 = supervisor.getDevice('m10')
m10.setPosition(float('inf'))

dsinside = supervisor.getDevice('dsinside')
dsinside.enable(timestep)
ds4s = supervisor.getDevice('ds4s')
ds4s.enable(timestep)
ds4sb = supervisor.getDevice('ds4sb')
ds4sb.enable(timestep)
ds4s1 = supervisor.getDevice('ds4s1')
ds4s1.enable(timestep)
#ds4sa = supervisor.getDevice('ds4sa')
#ds4sa.enable(timestep)
ds4sss = supervisor.getDevice('ds4sss')
ds4sss.enable(timestep)
ds4sssb = supervisor.getDevice('ds4sssb')
ds4sssb.enable(timestep)
ds1a= supervisor.getDevice('ds1a')
ds1a.enable(timestep)
ds1ab= supervisor.getDevice('ds1ab')
ds1ab.enable(timestep)
#ds1b= supervisor.getDevice('ds1b')
#ds1b.enable(timestep)
dso= supervisor.getDevice('dso')
dso.enable(timestep)
dsos= supervisor.getDevice('dsos')
dsos.enable(timestep)
dso1s= supervisor.getDevice('dso1s')
dso1s.enable(timestep)
ds= supervisor.getDevice('ds')
ds.enable(timestep)
dso1= supervisor.getDevice('dso1')
dso1.enable(timestep)
dsc= supervisor.getDevice('dsc')
dsc.enable(timestep)
dscs= supervisor.getDevice('dscs')
dscs.enable(timestep)
ds7s= supervisor.getDevice('ds7s')
ds7s.enable(timestep)
ds7sbs= supervisor.getDevice('ds7sbs')
ds7sbs.enable(timestep)
ds77= supervisor.getDevice('ds77')
ds77.enable(timestep)
ds5s= supervisor.getDevice('ds5s')
ds5s.enable(timestep)
ds5sb= supervisor.getDevice('ds5sb')
ds5sb.enable(timestep)
ds6= supervisor.getDevice('ds6')
ds6.enable(timestep)
ds4 = supervisor.getDevice('ds4')
ds4.enable(timestep)
ds5 = supervisor.getDevice('ds5')
ds5.enable(timestep)
ds7 = supervisor.getDevice('ds7')
ds7.enable(timestep)
dso1 = supervisor.getDevice('dso1')
dso1.enable(timestep)
lidar = supervisor.getDevice('lidar')
lidar.enable(timestep)
lidar1 = supervisor.getDevice('lidar1')
lidar1.enable(timestep)
lidar2 = supervisor.getDevice('lidar2')
lidar2.enable(timestep)
lidar4 = supervisor.getDevice('lidar4')
lidar4.enable(timestep)
cam = supervisor.getDevice('cam')
cam.enable(timestep)
cam1 = supervisor.getDevice('cam1')
cam1.enable(timestep)
push = supervisor.getDevice('push')
push.setVelocity(0.1)
push.setPosition(0)
pushss = supervisor.getDevice('pushss')
pushss.setVelocity(0.1)
pushss.setPosition(0)

pushmid = supervisor.getDevice('pushmid')
pushmid.setVelocity(0.1)
pushmid.setPosition(0)

midsensor = supervisor.getDevice('midsensor')
midsensor.enable(timestep)
midsensors = supervisor.getDevice('midsensors')
midsensors.enable(timestep)


bi2.setVelocity(0)
bi3.setVelocity(0)
bo2s.setVelocity(0)
bo3s.setVelocity(0)
turn.setVelocity(0)
turn1s.setVelocity(0)
turn2s.setVelocity(0)
bo.setVelocity(0)
bo1.setVelocity(0)
bo17.setVelocity(0)
bo12.setVelocity(0)
bo15.setVelocity(0)
bo16.setVelocity(0)

bi.setVelocity(0)
bi1.setVelocity(0)
turn.setVelocity(0)
turn1.setVelocity(0)
turn2.setVelocity(0)
m1.setVelocity(0)
m2.setVelocity(0)
m3.setVelocity(0)
m4.setVelocity(0)
m5.setVelocity(0)
m6.setVelocity(0)
m7.setVelocity(0)
m8.setVelocity(0)
m9.setVelocity(0)
m10.setVelocity(0)
bo17.setVelocity(0)
bo12.setVelocity(0)
bo15.setVelocity(0)
bo16.setVelocity(0)
bo2s.setVelocity(0)
bo3s.setVelocity(0)
bi2.setVelocity(0)
bi3.setVelocity(0)
bo17s.setVelocity(0)
bo16s.setVelocity(0)
bo2.setVelocity(0)
bo3.setVelocity(0)
bo13.setVelocity(0)
bo14.setVelocity(0)


m1s.setVelocity(0)
m2s.setVelocity(0)
m3s.setVelocity(0)
m4s.setVelocity(0)
m5s.setVelocity(0)
m6s.setVelocity(0)
m7s.setVelocity(0)
m8s.setVelocity(0)
m9s.setVelocity(0)
m10s.setVelocity(0)
motor_list = [m1, m2, m3, m4, m5, m6, m7, m8, m9, m10]
motor_list1 = [m1s, m2s, m3s, m4s, m5s, m6s, m7s, m8s, m9s, m10s]

def pallet_data(id, datass):
  date_now = datetime.now().date()
  mydb = sql()
  mycursor = mydb.cursor()
  sqls = "Insert into pallet(Sku, Inbound_date, Pallet_weight, Current_height, ProductID) values (%s, %s, %s, %s, %s)"
  val = (str(id), date_now, str(datass[2]), str(datass[3]), str(datass[1]))
  mycursor.execute(sqls, val)
  mydb.commit()
  print('complete')

def read_product_info(name):
  file_path = name+'.txt'
  with open(file_path, "r") as file:
    content = file.read()
    items = content.split(",")
    print(items)
    return items

def qrcodes(ca):
    qr_code_count = 0 
    image = ca.getImage()
    if(image == None):
      return None
    
    width, height = ca.getWidth(), ca.getHeight()
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
        
def remove_pallet(qr):
    num_children = supervisor.getFromDef(qr)
    if num_children is not None:
        num_children.remove()
    else:
        print(f"Node '{qr}' does not exist.")
            
def adjust_height(height, side, side1):
  turnm = 0
  turnm1 = 0
  syst = supervisor.getFromDef('pallet_system')
  num = syst.getField('children').getCount()
  for i in range(num):
    getdefine = syst.getField('children').getMFNode(i)
    turnmotor = getdefine.getDef()
    if(turnmotor == side):
      turnm = supervisor.getFromDef(turnmotor)
      translate = turnm.getField('translation').getSFVec3f()
      #turnm.getField('translation').setSFVec3f([0.91999, -2.56, 0.286578])
      turnm.getField('translation').setSFVec3f([translate[0], translate[1], height])
    if(turnmotor == side1):
      turnm1 = supervisor.getFromDef(turnmotor)
      translate1 = turnm1.getField('translation').getSFVec3f()
      #turnm.getField('translation').setSFVec3f([1.44999, -2.56, 0.287787])
      turnm1.getField('translation').setSFVec3f([translate1[0], translate1[1], height])

def adjust_turn(nom):
  turnm2 = 0
  syst = supervisor.getFromDef('pallet_system')
  num = syst.getField('children').getCount()
  for i in range(num):
    getdefine = syst.getField('children').getMFNode(i)
    turnmotor = getdefine.getDef()
    if(turnmotor == 'turnmiddle'):
      turnm2 = supervisor.getFromDef(turnmotor)
      translate = turnm2.getField('translation').getSFVec3f()
  if(nom == 1):
    turnm2.getField('translation').setSFVec3f([translate[0], translate[1], 0.294652])
  elif(nom == 2):
    turnm2.getField('translation').setSFVec3f([translate[0], translate[1], 0.28])
  else:
    turnm2.getField('translation').setSFVec3f([translate[0], translate[1], 0.2934])
      
def block(checkd, blo):
  syst = supervisor.getFromDef('pallet_system')
  num = syst.getField('children').getCount()
  for i in range(num):
    getdefine = syst.getField('children').getMFNode(i)
    turnmotor1 = getdefine.getDef()
    if(turnmotor1 == 'b88'):
      turnm1 = supervisor.getFromDef(turnmotor1).getField('children').getCount()
      print(turnm1)
      for i in range(turnm1):
        getdefine1 = supervisor.getFromDef(turnmotor1).getField('children').getMFNode(i)
        turnmotor = getdefine1.getDef()
        if(turnmotor == blo):
          turnm = supervisor.getFromDef(turnmotor)
          #turnm.getField('translation').setSFVec3f([0.91999, -2.56, 0.286578])
          translate = turnm.getField('translation').getSFVec3f()
          if(checkd == 0):
            turnm.getField('translation').setSFVec3f([translate[0], translate[1], 0.27])
          else:
            turnm.getField('translation').setSFVec3f([translate[0], translate[1], 0.36])
          #0.36

def block1(checkd, blo1):
  syst = supervisor.getFromDef('pallet_system')
  num = syst.getField('children').getCount()
  for i in range(num):
    getdefine = syst.getField('children').getMFNode(i)
    turnmotor1 = getdefine.getDef()
    if(turnmotor1 == 'b88'):
      turnm1 = supervisor.getFromDef(turnmotor1).getField('children').getCount()
      print(turnm1)
      for i in range(turnm1):
        getdefine1 = supervisor.getFromDef(turnmotor1).getField('children').getMFNode(i)
        turnmotor = getdefine1.getDef()
        if(turnmotor == blo1):
          turnm = supervisor.getFromDef(turnmotor)
          #turnm.getField('translation').setSFVec3f([0.91999, -2.56, 0.286578])
          translate = turnm.getField('translation').getSFVec3f()
          if(checkd == 0):
            turnm.getField('translation').setSFVec3f([translate[0], translate[1], 0.29])
          else:
            turnm.getField('translation').setSFVec3f([translate[0], translate[1], 0.34])
          #0.36

def generate_qr(da):
    mydb = sql()
    mycursor = mydb.cursor()
    mycursor.execute("SELECT Sku from pallet")
    myresult = mycursor.fetchall()
    if not myresult:
        key = "PLT-0"
    else:
        size = len(myresult)
        key = myresult[size-1][0]
        prefix, number = key.split("-")
        number = int(number) + 1
        key = f"PLT-{number}"
    print(f"Next SKU: {key}")

    current_directory = os.getcwd()
    project_directory = os.path.dirname(os.path.dirname(current_directory))
    worlds_dir = os.path.join(project_directory, 'worlds')

    qr = qrcode.QRCode(
        version=1,
        error_correction=qrcode.constants.ERROR_CORRECT_L,
        box_size=10,
        border=4,
    )

    data = key
    dat = f"PLT-{da}.png"
    qr.add_data(data)
    qr.make(fit=True)
    img = qr.make_image(fill_color="black", back_color="white")
    file_path = os.path.join(worlds_dir, dat)
    img.save(file_path)
    print(f"QR code image saved to: {file_path}")
    return key

def summon_pallet(da, pall_name):
    object_name = 'pallets'
    original_object = supervisor.getFromDef(object_name)
    object_string = original_object.exportString()
    object_string_with_texture = object_string.replace(
    'DEF qr1 Pose {',
    'DEF qr1 Pose { children [ Shape { translation 0.6 -0.02 0.05 rotation 0 0 1 3.14 appearance Appearance { texture ImageTexture { url "'+"PLT-"+str(da)+'.png" } } geometry Box { size 0.1 0.1 0.09 } } ]'
    )

  
    
    unique_object_name = pall_name
    
    ss = supervisor.getFromDef(unique_object_name)
    
    print(unique_object_name)
    
    if True:
    
        # Object with this name doesn't exist, create it
        object_string_with_texture = object_string_with_texture.replace(object_name, unique_object_name)
        rootNode = supervisor.getRoot()
        rootChildrenField = rootNode.getField('children')
        rootChildrenField.importMFNodeFromString(-1, object_string_with_texture)
        ss = supervisor.getFromDef(unique_object_name)
        ss.getField('rotation').setSFRotation([0, 0, 1, 1.5708])
        tt = ss.getField('translation')
        tt.setSFVec3f([-0.77, 0.30999, 0.42])
        return

def step():
  if (supervisor.step(timestep) == -1):
    supervisor.stepEnd()

def sql():
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="warehouse"
    )
    
    return mydb

def passive_wait(sec):
  start_time = supervisor.getTime()
  while (start_time + sec > supervisor.getTime()):
    step()

def setspeed(speedo):
  for motor in motor_list:
    motor.setVelocity(speedo)
  return 0
  
def setspeed1(speedo):
  for motor in motor_list1:
    motor.setVelocity(speedo)
  return 0

async def checkpoint(data):
  
  check = -1
  global c1
  global checkg
  global runq1 
  global runq
  global chkg
  global chkg1
  global checkg5
  checkg5 = 0
  chkg = 0
  runq = 0
  print('bab')
  print(data)

  while supervisor.step(timestep) != -1:
    count = 0
    count1 = 0
    ds_value = ds.getValue()
    ds4_value = ds4.getValue()
    dso1_value = dso1.getValue()
    lidar_value = lidar.getRangeImage()
    ds5_value = ds5.getValue()
    ds7_value = ds7.getValue()
    dscs_value = dscs.getValue()
    dsos_value = dsos.getValue()
    counta = 0


    if(check == -1):
      chkg = 1
      if(runq1 == 0):
        runq = 1
        if((chkg1 == 1 and chkg == 1) or (chkg1 == 0 and chkg == 1)):
          check = 0

    elif(check == 0):
      lidar_va = lidar.getRangeImage()
      lidar_va = np.array(lidar_va)
      countsa = np.sum(lidar_va < 2.0)
      bo.setVelocity(0)
      bo1.setVelocity(0)     
      turn.setVelocity(0)
      turn1.setVelocity(0)
      turn2.setVelocity(0)
      setspeed(0)
      if(countsa > 100):
        check = 0.1
        
    elif(check == 0.1):
      ds_value = ds.getValue()
      pall = generate_qr(data[1])
      productdata = read_product_info('pallet_system')
      pallet_data(pall, productdata)
      summon_pallet(data[1], pall)
      if(ds_value == 1000):
        #move straight
        adjust_turn(2)
        adjust_height(0.291, 'turnleft', 'turnleft1')
        bo.setVelocity(0.27)
        bo1.setVelocity(0.27)     
        turn.setVelocity(0)
        turn1.setVelocity(0)
        turn2.setVelocity(0)
        setspeed(0)
        check = 0.2

    elif(check == 0.2):
      ds_value = ds.getValue()
      if(ds_value < 1000):
        #go left side
        bo.setVelocity(0)
        bo1.setVelocity(0)   
        adjust_turn(1)  
        turn.setVelocity(5)
        turn1.setVelocity(0.9)
        turn2.setVelocity(0.9)
        setspeed(5)
        check = 1

            
    elif(check == 1):
      bo2.setVelocity(0)
      bo3.setVelocity(0)
      bi.setVelocity(0)
      bi1.setVelocity(0)
      bo.setVelocity(0)
      bo1.setVelocity(0)    
      #turn.setVelocity(0)
      ds4_value = ds4.getValue()
      print(ds4_value)
      if(ds4_value < 1000):
        #go straight
        adjust_height(0.276, 'turnleft', 'turnleft1')
        passive_wait(1)
        runq = 0
        chkg = 0
        bo2.setVelocity(-0.27)
        bo3.setVelocity(-0.27)
        bi.setVelocity(-0.27)
        bi1.setVelocity(-0.27)
        turn1.setVelocity(0)
        turn2.setVelocity(0)
        check = 2
                
    elif(check == 2):       
      dso1_value = dso1.getValue() 
      #check pallet arrive or not
      if(dsos_value < 1000):
        bo2.setVelocity(0)
        bo3.setVelocity(0)
        bi.setVelocity(0)
        bi1.setVelocity(0)
        check = 3

    elif(check == 3):
      lidar_va1 = lidar.getRangeImage()
      countsa1 = 0
      print(lidar_va1)
      for i in range(500):
        if(lidar_va1[i] == float('inf')):
          countsa1 = countsa1 + 1
          
      if(countsa1 > 200 and dscs_value < 1000):
        if(ds5_value != 1000):
          bo13.setVelocity(0)
          bo14.setVelocity(0)
          bo16s.setVelocity(0)
          bo17s.setVelocity(0)

        elif(ds5_value == 1000): 
          check = 7      
          
    elif(check == 7):
      bi.setVelocity(0.27)
      bi1.setVelocity(0.27)
      bo2.setVelocity(0.27)
      bo3.setVelocity(0.27)
      bo13.setVelocity(0.27)
      bo14.setVelocity(0.27)
      
      if(ds5_value != 1000):
        bi.setVelocity(0)
        bi1.setVelocity(0)
        bo2.setVelocity(0)
        bo3.setVelocity(0)
        bo13.setVelocity(0)
        bo14.setVelocity(0)
        bo16s.setVelocity(0)
        bo17s.setVelocity(0)   
        check = 7.2                    
            
    elif(check == 7.2):
      if(ds7_value == 1000):
        bo13.setVelocity(0.27)
        bo14.setVelocity(0.27)
        bo16s.setVelocity(0.27)
        bo17s.setVelocity(0.27)
        check = 7.3
        
    elif(check == 7.3):
      if(ds7_value != 1000):
        bo13.setVelocity(0)
        bo14.setVelocity(0)
        bo16s.setVelocity(0)
        bo17s.setVelocity(0)
        PS_check(productdata[0])
        checkg = 1
        c1 = 0
        check = 7.31

    if(check == 7.31):
      if(ds7_value == 1000):
        c1 = 0
        checkg5 = 1
        return
    await asyncio.sleep(0.01) 

async def checkpoint1(data):
  
  check = -1
  check1 = 0
  global c2
  global checkg2
  global checkg6
  global masa
  global masa1
  masa = None
  masa1 = None
  global runq1 
  global runq
  global chkg
  global chkg2
  chkg2 = 0
  runq1 = 0
  checkg2 = 0
  checkg6 = 0

  while supervisor.step(timestep) != -1:
    count = 0
    count1 = 0
    ds_value = ds.getValue()
    ds4s1_value = ds4s1.getValue()
    dso1_value = dso1s.getValue()
    lidar_value = lidar2.getRangeImage()
    ds5_value = ds5s.getValue()
    ds7_value = ds77.getValue()
    counta = 0
    dsc_value = dsc.getValue()
    dso_value = dso.getValue()
  
    if(check == -1):
      chkg1 = 1
      if(runq == 0):
        if(chkg1 == 1 and chkg == 0):
          runq1 = 1
          check = 0

    if(check == 0):
      lidar_va = lidar2.getRangeImage()
      lidar_va = np.array(lidar_va)
      countsa = np.sum(lidar_va < 2.0)
      bo.setVelocity(0)
      bo1.setVelocity(0)     
      turn.setVelocity(0)
      turn1s.setVelocity(0)
      turn2s.setVelocity(0)
      setspeed1(0)
      if(countsa > 200):
        check = 0.1
        
    elif(check == 0.1):
      ds_value = ds.getValue()
      pall = generate_qr(data[1])
      productdata = read_product_info('pallet_system1')
      pallet_data(pall, productdata)
      summon_pallet(data[1], pall)
      if(ds_value == 1000):
        adjust_turn(2)
        adjust_height(0.291, 'turnright', 'turnright1')
        bo.setVelocity(0.27)
        bo1.setVelocity(0.27)     
        turn.setVelocity(0)
        turn1s.setVelocity(0)
        turn2s.setVelocity(0)
        setspeed1(0)
        check = 0.2

    elif(check == 0.2): 
      ds_value = ds.getValue()
      if(ds_value < 1000):
        bo.setVelocity(0)
        bo1.setVelocity(0)     
        adjust_turn(1)
        turn.setVelocity(-2.5)
        turn1s.setVelocity(-2.5)
        turn2s.setVelocity(-2.5)
        setspeed1(5)
        check = 1
  
            
    elif(check == 1):
      bo2s.setVelocity(0)
      bo3s.setVelocity(0)
      bi3.setVelocity(0)
      bi2.setVelocity(0)
      bo.setVelocity(0)
      bo1.setVelocity(0)    
      #turn.setVelocity(0)
      ds4_value = ds4s1.getValue()
      print(ds4_value)
      if(ds4_value < 1000):
        adjust_height(0.276, 'turnright', 'turnright1')
        passive_wait(1)
        runq1 = 0
        chkg1 = 0
        bo2s.setVelocity(-0.27)
        bo3s.setVelocity(-0.27)
        bi2.setVelocity(-0.27)
        bi3.setVelocity(-0.27)
        turn1s.setVelocity(0)
        turn2s.setVelocity(0)
        check = 2
                
    elif(check == 2):       
      dso1_value = dso1s.getValue() 
      if(dso_value < 1000):
        bo2s.setVelocity(0)
        bo3s.setVelocity(0)
        bi2.setVelocity(0)
        bi3.setVelocity(0)
        check = 3
  
    elif(check == 3):
      lidar_va1 = lidar2.getRangeImage()
      countsa1 = 0
      print(lidar_va1)
      for i in range(500):
        if(lidar_va1[i] == float('inf')):
          countsa1 = countsa1 + 1
          
      if(countsa1 > 200 and dsc_value < 1000):
        if(ds5_value != 1000):
          bo15.setVelocity(0)
          bo16.setVelocity(0)
          bo12.setVelocity(0)
          bo17.setVelocity(0)
          check = 7   
        elif(ds5_value == 1000): 
          check = 7       
          
    elif(check == 7):
      bi2.setVelocity(0.27)
      bi3.setVelocity(0.27)
      bo2s.setVelocity(0.27)
      bo3s.setVelocity(0.27)
      bo15.setVelocity(0.27)
      bo16.setVelocity(0.27)
      
      if(ds5_value != 1000):
        bi2.setVelocity(0)
        bi3.setVelocity(0)
        bo2s.setVelocity(0)
        bo3s.setVelocity(0)
        bo15.setVelocity(0)
        bo16.setVelocity(0)
        bo12.setVelocity(0)
        bo17.setVelocity(0)   
        check = 7.2  
                      
    elif(check == 7.2):
      if(ds7_value == 1000):
        bo15.setVelocity(0.27)
        bo16.setVelocity(0.27)
        bo12.setVelocity(0.27)
        bo17.setVelocity(0.27)
        check = 7.3
        
    elif(check == 7.3):
      if(ds7_value != 1000):
        bo15.setVelocity(0)
        bo16.setVelocity(0)
        bo12.setVelocity(0)
        bo17.setVelocity(0)
        PS_check(productdata[0])
        checkg2 = 1
        c2 = 0
        check = 7.31

    elif(check == 7.31):
      c2 = 0
      checkg6 = 1
      return 
    await asyncio.sleep(0.01)

async def checkpoint2(data):
  #PS_check(data[1])
  check = -1.1 
  check1 = 0
  global c1
  global checkg
  global chkg
  global chkg1
  global runq
  global runq1
  runq = 0
  chkg = 0
  qr = None
  while supervisor.step(timestep) != -1:
    count = 0
    count1 = 0  
    dso_value = dsos.getValue()
    dsc_value = dscs.getValue()
    ds7s_value = ds7sbs.getValue()
    ds4s_value = ds4sb.getValue()
    #ds4sa_value = ds4sa.getValue()
    ds5s_value = ds5sb.getValue()
    ds6_value = ds6.getValue()
    ds4sss_value = ds4sssb.getValue()
    ds1a_value = ds1ab.getValue()
    dsinside_value = dsinside.getValue()
    print(dsinside_value)
    #ds1b_value = ds1b.getValue()
    lidar1_value = lidar4.getRangeImage()
    lidar_value = lidar.getRangeImage()

    lidar_value = np.array(lidar_value)
    lidar1_value = np.array(lidar1_value)
    if(check == -1.1):
      count = np.sum(lidar1_value > 200)
      if(count > 200):
        check = -1

    if(check == -1):
      qr = qrcodes(cam)

      if(qr != None):
        print(qr)
        check = 0
      else:
        print("None")

    elif(check == 0):
      count1 = np.sum(lidar_value > 200)

      if(ds7s_value != 1000 and dso_value == 1000 and count1 > 200):
        bo17s.setVelocity(-0.27)
        bo16s.setVelocity(-0.27)
        bo14.setVelocity(-0.27)
        bo13.setVelocity(-0.27)
        bo2.setVelocity(-0.27)
        bo3.setVelocity(-0.27)
        bi.setVelocity(-0.27)
        bi1.setVelocity(-0.27)
        check = 1
                
    elif(check == 1):
      if(dso_value != 1000):
        bo17s.setVelocity(0)
        bo16s.setVelocity(0)
        bo13.setVelocity(0)
        bo14.setVelocity(0)
        bo2.setVelocity(0)
        bo3.setVelocity(0)
        bi.setVelocity(0)
        bi1.setVelocity(0)
        check = 1.11

    elif(check == 1.11):
      block(1, 'block1')
      adjust_turn(2)
      check = 2           
            
    elif(check == 2):        
      if(dsc_value >= 1000 and dso_value != 1000):
        bi.setVelocity(0.27)
        bi1.setVelocity(0.27)
        bo2.setVelocity(0.27)
        bo3.setVelocity(0.27)
        check = 4

    elif(check == 4):
      if(dsc_value >= 1000):
        bi.setVelocity(0.27)
        bi1.setVelocity(0.27)
        bo2.setVelocity(0.27)
        bo3.setVelocity(0.27)
        check = 5
    
    elif(check == 5):            
      if(ds4s_value != 1000):
        bi.setVelocity(0)
        bi1.setVelocity(0)
        bo2.setVelocity(0)
        bo3.setVelocity(0)
        chkg = 1
        check = 6.1

    elif(check == 6.1):   
      if(runq1 == 0):
        if((chkg1 == 1 and chkg == 1) or (chkg1 == 0 and chkg == 1)):
          runq = 1
          block(1, 'block')
          check = 6
            
    elif(check == 6):
      if(ds4sss_value != 1000): 
        #pushss.setPosition(0.13)
        adjust_height(0.3, 'turnleft', 'turnleft1')           
        turn1.setVelocity(-2.5)
        turn2.setVelocity(-2.5)
        setspeed(-8.77)
        turn.setVelocity(-1.5)
        bo.setVelocity(0)
        bo1.setVelocity(0)
        check = 7.01

    elif(check == 7.01):    
      if(midsensor.getValue() != 1000):
        adjust_turn(1)  
        check = 7

    elif(check == 7):
      if(ds1a_value != 1000):
        checkg = 1
        #pushss.setPosition(0)
        turn1.setVelocity(0)
        turn2.setVelocity(0)
        turn.setVelocity(0)
        adjust_turn(0)
        adjust_height(0.28, 'turnleft', 'turnleft1')
        passive_wait(1)
        block(0, 'block')
        block(0, 'block1')
        #pushmid.setPosition(-0.12)
        #passive_wait(1)
        bo.setVelocity(-0.27)
        bo1.setVelocity(-0.27)
        bo17s.setVelocity(-0.27)
        bo16s.setVelocity(-0.27)
        bo2.setVelocity(-0.27)
        bo3.setVelocity(-0.27)
        bi.setVelocity(-0.27)
        bi1.setVelocity(-0.27)
        check = 7.05

    elif(check == 7.05):
      if(dsinside_value != 1000):
        bo.setVelocity(0)
        bo1.setVelocity(0)
        bo17s.setVelocity(0)
        bo16s.setVelocity(0)
        bo2.setVelocity(0)
        bo3.setVelocity(0)
        bi.setVelocity(0)
        bi1.setVelocity(0)
        remove_pallet(qr)
        chkg = 0
        checkg = 1
        runq = 0
        c1 = 0
        PS_check(data[1])
        return
    await asyncio.sleep(0.01)

async def checkpoint3(data):
  #PS_check(data[1])
  check = -1.1
  check1 = 0
  global c2
  global checkg
  global checkg2
  global runq 
  global runq1
  runq1 = 0
  global chkg
  global chkg1 
  chkg1 = 0
  qr = None
  while supervisor.step(timestep) != -1:
    count = 0
    count1 = 0    
    dso_value = dso.getValue()
    dsc_value = dsc.getValue()
    ds7s_value = ds7s.getValue()
    ds4s_value = ds4s.getValue()
    #ds4sa_value = ds4sa.getValue()
    ds4sss_value = ds4sss.getValue()
    ds1a_value = ds1a.getValue()
    #ds1b_value = ds1b.getValue()
    dsinside_value = dsinside.getValue()
    
    if(check == -1.1):
      lidar1_value = lidar1.getRangeImage()
      lidar_value = lidar2.getRangeImage()
      lidar_value = np.array(lidar_value)
      lidar1_value = np.array(lidar1_value)
      count = np.sum(lidar1_value > 200)
      if(count > 200):
        check = -1

    if(check == -1):
      qr = qrcodes(cam1)

      if(qr != None):
        print(qr)
        check = 0
      else:
        print("None")

    if(check == 0):
      count1 = np.sum(lidar_value > 200)
      if(ds7s_value != 1000 and dso_value == 1000 and count1 > 200):
        bo17.setVelocity(-0.27)
        bo12.setVelocity(-0.27)
        bo15.setVelocity(-0.27)
        bo16.setVelocity(-0.27)
        bo2s.setVelocity(-0.27)
        bo3s.setVelocity(-0.27)
        bi2.setVelocity(-0.27)
        bi3.setVelocity(-0.27)
        check = 1
                
    elif(check == 1):
      if(dso_value != 1000):
        bo17.setVelocity(0)
        bo12.setVelocity(0)
        bo15.setVelocity(0)
        bo16.setVelocity(0)
        bo2s.setVelocity(0)
        bo3s.setVelocity(0)
        bi2.setVelocity(0)
        bi3.setVelocity(0)
        check = 1.11
    
    elif(check == 1.11):
        block(1, 'blocks1')
        adjust_turn(2)
        check = 2
               
    elif(check == 2):        
      if(dsc_value >= 1000 and dso_value != 1000):
        bi2.setVelocity(0.27)
        bi3.setVelocity(0.27)
        bo2s.setVelocity(0.27)
        bo3s.setVelocity(0.27)
        check = 4

    elif(check == 4):
      if(dsc_value >= 1000):
        bi2.setVelocity(0.27)
        bi3.setVelocity(0.27)
        bo2s.setVelocity(0.27)
        bo3s.setVelocity(0.27)
        check = 5
    
    elif(check == 5):         
      if(ds4s_value != 1000):
        bi2.setVelocity(0)
        bi3.setVelocity(0)
        bo2s.setVelocity(0)
        bo3s.setVelocity(0)
        chkg1 = 1
        check = 6.1

    elif(check == 6.1):   
      if(runq == 0):
        if(chkg1 == 1 and chkg == 0):
          runq1 = 1
          block(1, 'blocks')
          check = 6    
            
    elif(check == 6):
      if(ds4sss_value != 1000): 
        #push.setPosition(-0.13) 
        adjust_height(0.3, 'turnright', 'turnright1')           
        turn1s.setVelocity(2.5)
        turn2s.setVelocity(2.5)
        setspeed1(-8.77)
        turn.setVelocity(1.5)
        bo.setVelocity(0)
        bo1.setVelocity(0)
        check = 7.01

    elif(check == 7.01):    
      if(midsensors.getValue() != 1000):
        adjust_turn(1)  
        check = 7

    elif(check == 7):
      if(ds1a_value != 1000):
        push.setPosition(0)
        checkg = 1
        #pushmid.setPosition(-0.12)
        turn1s.setVelocity(0)
        turn2s.setVelocity(0)
        turn.setVelocity(0)
        adjust_turn(0)
        adjust_height(0.28, 'turnright', 'turnright1')
        passive_wait(1)
        block(0, 'blocks1')
        block(0, 'blocks')
        setspeed1(0)
        bo.setVelocity(-0.27)
        bo1.setVelocity(-0.27)
        bo15.setVelocity(-0.27)
        bo16.setVelocity(-0.27)
        bo2s.setVelocity(-0.27)
        bo3s.setVelocity(-0.27)
        bi2.setVelocity(-0.27)
        bi3.setVelocity(-0.27)
        check = 7.05
               
    elif(check == 7.05):
      if(dsinside_value != 1000):
        bo.setVelocity(0)
        bo1.setVelocity(0)
        bo17s.setVelocity(0)
        bo16s.setVelocity(0)
        bo2.setVelocity(0)
        bo3.setVelocity(0)
        bi.setVelocity(0)
        bi1.setVelocity(0)
        remove_pallet(qr)
        checkg2 = 1
        chkg1 = 0
        runq1 = 0
        c2 = 0
        PS_check(data[1])
        return
    await asyncio.sleep(0.01)

def PowerOn():

  mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="warehouse"
  ) 

  mycursor = mydb.cursor()

  mycursor.execute("SELECT * FROM conveyor where ConveyorName = 'C01'")

  myresult = mycursor.fetchall()

  if myresult:
    mycursor.execute("Update conveyor set Status = '1' where ConveyorName = 'C01'")
    mydb.commit()

  else:
    sql = "Insert into conveyor(ConveyorName, Status) values (%s, %s)"
    val = ("C01", "1")
    mycursor.execute(sql, val)
    mydb.commit()
    
def PowerOff():

  mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="",
  database="warehouse"
  ) 

  mycursor = mydb.cursor()

  mycursor.execute("Update conveyor set Status = '0' where ConveyorName = 'C01'")
  mydb.commit()

def checking_database(lane):
    bp = 0
    date_time_format = "%Y-%m-%d %H:%M:%S"
    mydb = sql()

    checkpoint = 0
    checkpoint1 = 0
    mycursor = mydb.cursor()
    if(lane == 1):
    #mycursor.execute("SELECT task.Date, task.Time, product.Product_Name, task.TaskID FROM task inner join product on task.ProductID = product.ProductID where PS_check = '0' and Action = 'Store' and AGV_check = '0' and SC_check = '0' and Forklift_check = '1'")
      mycursor.execute("SELECT task.Date, task.Time, product.Product_Name, task.TaskID FROM task inner join product on task.ProductID = product.ProductID where task.PS_check = '0' and task.Action = 'Store' and task.AGV_check = '0' and task.SC_check = '0' and task.Forklift_check = '1' and task.Lane = '1'")
    elif(lane == 2):
      mycursor.execute("SELECT task.Date, task.Time, product.Product_Name, task.TaskID FROM task inner join product on task.ProductID = product.ProductID where task.PS_check = '0' and task.Action = 'Store' and task.AGV_check = '0' and task.SC_check = '0' and task.Forklift_check = '1' and task.Lane = '2'")

    myresult = mycursor.fetchall()
    print(myresult)
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
    if(lane == 1):
      mycursor.execute("SELECT task.Date, task.Time, product.Product_Name, task.TaskID, task.Sku FROM task inner join product on task.ProductID = product.ProductID where task.PS_check = '0' and task.Action = 'Retrieve' and task.AGV_check = '1' and task.SC_check = '1' and task.Forklift_check = '0' and task.Lane = '1'")
    elif(lane == 2):
      mycursor.execute("SELECT task.Date, task.Time, product.Product_Name, task.TaskID, task.Sku FROM task inner join product on task.ProductID = product.ProductID where task.PS_check = '0' and task.Action = 'Retrieve' and task.AGV_check = '1' and task.SC_check = '1' and task.Forklift_check = '0' and task.Lane = '2'")
    
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
        data=["1", myresult[min][3], myresult[min][2]]
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
      data=["1", myresult[min][3], myresult[min][2]]
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

def outbound_date(sku):
  mydb = sql()
  mycursor = mydb.cursor()
  date_now = datetime.date.today()
  sqls = "update pallet set Outbound_date = %s where Sku = %s"
  val = (date_now, sku)
  mycursor.execute(sqls, val)
  mydb.commit()

def PS_check(taskid):
  mydb = sql()
  mycursor = mydb.cursor()
  sqls = "update task set PS_check = '1' where TaskID = %s"
  val = (taskid, )
  mycursor.execute(sqls, val)
  mydb.commit()

def main():        
  c1 = 0 
  c2 = 0
  c3 = 0
  c4 = 0 
  mode = 0
  global checkg
  global checkg1
  checkg = 1
  checkg1 = 1
  
  while supervisor.step(timestep) != -1:
    lam = 0
    lam1 = 0
    lam2 = 0
    lam3 = 0
    print(mode, lam, lam1, lam2)
    if receiver.getQueueLength() > 0:
      image = receiver.getString()
      receiver.nextPacket()
      print('bbbbbbb')
      obj = int(image)
      if(obj == 0 or obj == 2):
        mode = 1

      elif(obj == 1):
        mode = 0
      
      elif(obj == 3):
        mode = 2

    if(mode == 2):
      PowerOn()
        
    #inbound
    if(mode == 0):
      lidar_valuee = lidar.getRangeImage()
      lidar_valuee1 = lidar2.getRangeImage()
      for i in range(500):
        if(lidar_valuee[i] != float('inf')):
          lam = lam + 1
        if(lidar_valuee1[i] != float('inf')):
          lam1 = lam1 + 1
      print(lam)
      if(lam > 200):
        if c1 == 0:
          if checkg == 1 and checkg1 == 1:
            mm = threading.Thread(target=checkpoint)
            mm.daemon = True
            mm.start()
            c1 = 1
            checkg = 0
          else:
            print('wait')
        else:
          print('Please Wait')            
          
      elif(lam1 > 200):
        if c2 == 0:
          if checkg == 1 and checkg == 1:
            mm1 = threading.Thread(target=checkpoint1)
            mm1.daemon = True
            mm1.start()
            c2 = 1
            checkg = 0
          else:
            print('wait')
        else:
          print('Please Wait')

    elif(mode == 1):
      lidar_valuee2 = lidar4.getRangeImage()
      lidar_valuee3 = lidar1.getRangeImage()
    
      for i in range(500):
        if(lidar_valuee2[i] != float('inf')):
          lam2 = lam2 + 1
        if(lidar_valuee3[i] != float('inf')):
          lam3 = lam3 + 1

      if(lam2 > 200):
        if c3 == 0:
          if checkg1 == 1:
            mm2 = threading.Thread(target=checkpoint2)
            mm2.daemon = True
            mm2.start()
            c3 = 1
            checkg1 = 0
          else:
            print('Wait')
        else:
          print('Please Wait')            
  
      elif(lam3 > 200):
        mode = 2
        checkpoint3()  
        if c4 == 0:
          if checkg1 == 1:
            mm3 = threading.Thread(target=checkpoint3)
            mm3.daemon = True
            mm3.start()
            c4 = 1
            checkg1 = 0
          else:
            print('Wait')
        else:
          print('Please Wait')            

def mode1():
  global c1
  global c2
  global checkg
  global checkg1
  c1 = 0 
  c2 = 0
  checkg = 1
  checkg1 = 1

  while supervisor.step(timestep) != -1:
    lam = 0
    lam1 = 0
    lan = 0
    lan1 = 0

    #inbound
    lidar_valuee = lidar.getRangeImage()   #fork
    lidar_valuee2 = lidar4.getRangeImage() #AGV

    lidar_valuee1 = lidar2.getRangeImage() #fork
    lidar_valuee3 = lidar1.getRangeImage() #AGV
    
    if(checkg == 1):
      for i in range(500):
        if(lidar_valuee[i] != float('inf')):
          lam = lam + 1
        if(lidar_valuee2[i] != float('inf')):
          lam1 = lam1 + 1
    
    if(checkg == 1):
      for i in range(500):
        if(lidar_valuee3[i] != float('inf')):
          lan = lan + 1
        if(lidar_valuee1[i] != float('inf')):
          lan1 = lan1 + 1

    if(c1 == 0):
      if(lam > 200):
        if checkg == 1:
          mm = threading.Thread(target=checkpoint)
          mm.daemon = True
          mm.start()
          c1 = 1
          checkg = 0       
          
      elif(lam1 > 200):
        if checkg == 1:
          mm1 = threading.Thread(target=checkpoint2)
          mm1.daemon = True
          mm1.start()
          c1 = 1
          checkg = 0

    if(c2 == 0):
      if(lan1 > 200):
          if checkg == 1:
            print('runnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn')
            mm2 = threading.Thread(target=checkpoint1)
            mm2.daemon = True
            mm2.start()
            c2 = 1
            checkg = 0        
  
      elif(lan > 200):
          if checkg == 1:
            mm3 = threading.Thread(target=checkpoint3)
            mm3.daemon = True
            mm3.start()
            c2 = 1
            checkg = 0
    
async def mode2():
    global c1, c2, checkg, checkg1, checkg2, checkdata, checkdata1, data, data1, runq, runq1, chkg, chkg1, checkg5, checkg6
    c1 = 0
    c2 = 0
    checkg = 0
    checkg1 = 0
    checkg2 = 0
    checkdata = 0
    checkdata1 = 0
    data = ['0', '0']
    data1 = ['0', '0']
    runq = 0
    runq1 = 0 
    chkg = 0
    chkg1 = 0
    checkg5 = 1
    checkg6 = 1
    while supervisor.step(timestep) != -1:
        lam = 0
        lam1 = 0
        lan = 0
        lan1 = 0

        if checkdata == 0:
            checkg = 0
            datas = checking_database(1)
            if datas is not None and datas != []:
                data = datas
                checkdata = 1
                checkg = 1
            else:
                checkg = 0

        if checkdata1 == 0:
            checkg2 = 0
            await asyncio.sleep(0.2)
            data1s = checking_database(2)
            if data1s is not None and data1s != []:
                data1 = data1s
                checkdata1 = 1
                checkg2 = 1
            else:
                checkg2 = 0

        if checkg == 1:
            if data[0] == '1':
                lidar_valuee = lidar.getRangeImage()   #fork
                for i in range(500):
                    if lidar_valuee[i] != float('inf'):
                        lam += 1
            elif data[0] == '2':
                lidar_valuee2 = lidar4.getRangeImage() #AGV
                for i in range(500):
                    if lidar_valuee2[i] != float('inf'):
                        lam1 += 1

        if checkg2 == 1:
            print('out')
            if data1[0] == '1':
                lidar_valuee3 = lidar2.getRangeImage() #fork
                for i in range(500):
                    if lidar_valuee3[i] != float('inf'):
                        lan += 1
            elif data1[0] == '2':
                lidar_valuee1 = lidar1.getRangeImage() #AGV
                for i in range(500):
                    if lidar_valuee1[i] != float('inf'):
                        lan1 += 1

        if c1 == 0:
            if lam > 200:
                if checkg == 1:
                    asyncio.create_task(checkpoint(data))
                    c1 = 1
                    checkg = 0
                    checkg5 = 0

            elif lam1 > 200:
                if checkg == 1:
                    if checkg5 == 1:
                        asyncio.create_task(checkpoint2(data))
                        c1 = 1
                        checkg = 0

        if c2 == 0:
            if lan1 > 200:
                if checkg2 == 1:
                    asyncio.create_task(checkpoint3(data1))
                    c2 = 1
                    checkg2 = 0
                    checkg6 = 0
            elif lan > 200:
                if checkg2 == 1:
                    if checkg6 == 1:
                        asyncio.create_task(checkpoint1(data1))
                        c2 = 1
                        checkg2 = 0

        await asyncio.sleep(0.01)


if __name__ == "__main__":
    asyncio.run(mode2())
      
      

     


