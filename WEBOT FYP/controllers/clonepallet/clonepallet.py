from controller import Supervisor, DistanceSensor
import random

# Create a Webots supervisor
supervisor = Supervisor()
pps = 0.1  # Initial X-coordinate value
TIME_STEP = 32
bss = 0

# Create a dictionary to store objects and their random weights
objects = {}

di = 0
def step():
    if supervisor.step(TIME_STEP) == -1:
        supervisor.stepEnd()

def passive_wait(sec):
    start_time = supervisor.getTime()
    while start_time + sec > supervisor.getTime():
        step()

while supervisor.step(TIME_STEP) != -1:
   # di = distance_sensor.getValue()
   #` print(f'dis : {di}')
   
    if di == 0: #<= 0.35:
        #x = random.randint(1,2)  # Randomly select 1 or 2
        x=1
        if x == 1:
            object_name = 'pallets'
            weight = 2  # Assign weight 2 for 'pallet'
        else:
            object_name = 'pepe'
            weight = 1  # Assign weight 1 for 'pal'
        print(f"random: {x}")
        original_object = supervisor.getFromDef(object_name)
        object_string = original_object.exportString()
     
        object_string_with_texture = object_string.replace(
        'DEF qr1 Pose {',
        'DEF qr1 Pose { children [ Shape { translation 0.6 -0.02 0.05 rotation 0 0 1 3.14 appearance Appearance { texture ImageTexture { url "highvoltage.jpg" } } geometry Box { size 0.1 0.1 0.09 } } ]'
        )

        counter = 1  # Initialize a counter
        
        while True:
            unique_object_name = f'{object_name}_{counter}'  # Generate a unique object name
            ss = supervisor.getFromDef(unique_object_name)
            print(unique_object_name)
            if ss is None:
                # Object with this name doesn't exist, create it
                object_string_with_texture = object_string_with_texture.replace(object_name, unique_object_name)
                rootNode = supervisor.getRoot()
                rootChildrenField = rootNode.getField('children')
                rootChildrenField.importMFNodeFromString(4, object_string_with_texture)
                
                ss = supervisor.getFromDef(unique_object_name)
                ss.getField('rotation').setSFRotation([0, 0, 1, 1.5708])
                
                # Set the position to [2.1, 0.1, 0]
                tt = ss.getField('translation')
                tt.setSFVec3f([-0.77, 0.30999, 0.42])
                
                # Assign the weight based on the object_name
                random_weight = weight
                
                # Store the object and its weight in the dictionary
                objects[unique_object_name] = random_weight
                
                ss1 = supervisor.getFromDef(unique_object_name)
                print(f"Created object: {unique_object_name}, random weight: {random_weight}")
                object_to_remove = supervisor.getFromDef("pallets")
                object_to_remove.remove()
                passive_wait(100)
                break
            else:
                counter += 1

        bss = 1
        di = 1
        object_to_remove = supervisor.getFromDef("pallets")
        supervisor.removeMF(object_to_remove)