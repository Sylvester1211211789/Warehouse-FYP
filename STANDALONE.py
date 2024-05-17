import sys
import time
from controller import Robot, Emitter
import mysql.connector

time_step = 32
robot = Robot()
emitter = robot.getDevice('emitter')
emitter.setChannel(2)

try:
    connection = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="warehouse"
    )
    
    if connection.is_connected():
        while robot.step(time_step) != -1:
            mycursor = connection.cursor()
            sql = "SELECT Action, Lane FROM task"
            mycursor.execute(sql)
            myresult = mycursor.fetchone()
            
            if myresult: 
                Action, Lane = myresult  # Assign fetched values to Action and Lane
                #print("action:", Action)
                #print("lane:", Lane)
                if Lane == 1:
                    if Action == 1:
                        print('1 in')
                        mode = 11
                    else:
                        print('1 out')
                        mode = 12
                    print(mode)
                    message = str(mode)
                    emitter.send(message)
                elif Lane == 2:
                    if Action == 1:
                        print('2 in')
                        mode = 21
                    else:
                        print('2 out')
                        mode = 22
                    message = str(mode)
                    emitter.send(message)
                elif Lane == 3:
                    if Action == 1:
                        print('2 in')
                        mode = 31
                    else:
                        print('3 out')
                        mode = 32
                    message = str(mode)
                    emitter.send(message)                    
                else:
                    mode = 0
                    print('No Task')
            else:
                print('Noooo Task')
                mode = 0

except mysql.connector.Error as e:
    print("Error:", e)
