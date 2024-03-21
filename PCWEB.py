import sys
import time
from controller import Robot
import webbrowser
def main():
    robot = Robot()
    touch_sensor = robot.getDevice("web")
    display = robot.getDevice("display")
    time_step = int(robot.getBasicTimeStep())
    touch_sensor.enable(time_step)
 
    i = 0
    image_paths_start = 'C:\\Users\\12112\\OneDrive\\Pictures\\start.jpg'
    def open_webot():
        webbrowser.open("http://localhost/warehouse/main.html")

    while robot.step(time_step) != -1:

        if touch_sensor.getValue() == 1:
            print("Opening..............")
            open_webot()
            image = display.imageLoad(image_paths_start)
            display.imagePaste(image, 0, 0, False)
if __name__ == "__main__":
    main()
