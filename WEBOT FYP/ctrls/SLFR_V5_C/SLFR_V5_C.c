/*
 * File:          SLFR_V5_C.c
 * Date:
 * Description:
 * Author:
 * Modifications:
 */

/*
 * <webots/motor.h>, etc.
 */
#include <stdio.h>
#include <webots/robot.h>
#include <webots/motor.h>
#include <webots/distance_sensor.h>
#include <webots/camera.h>
#include <webots/led.h>
#include <webots/supervisor.h>

int time_step = 0;

// Motors
WbDeviceTag left_motor, right_motor;

// IR Ground Sensors
WbDeviceTag gs[8];

// lEDs
WbDeviceTag led[5];

// Robots
WbNodeRef robotX;

// PID
int Kp=14;
float Ki=0.02;
float Kd=0.12;

float P=0, I=0, D=0, oldP=0, PID=0;

// Max velocity
#define maxS 138

float left_speed, right_speed;


int Error_Position(int Pos){
  int online = 0;
  unsigned int PosX = 0;
  
  for(int i=0; i<8; i++){
    if(wb_distance_sensor_get_value(gs[i]) > 200){
      PosX += i;
      online += 1;
    }
  }
  
 if(online == 0) return Pos;
 return PosX / online - 3.5;
 
}

void LineFollowingModule(void){
  float medS = 0;
  /* Error Position Calculation & PID */
  P = Error_Position(P);
  I += P * time_step/1000;
  D = D * 0.5 + (P-oldP) / time_step * 1000;
  PID = Kp * P + Ki * I + Kd * D;
  oldP = P;  
  
  medS = maxS - abs(PID);
  left_speed = medS + PID;
  right_speed = medS - PID;
}

void PosLED(){
  if((P>-1)&&(P<1)) wb_led_set(led[1],1);
  else wb_led_set(led[1],0);
  
  if(P < -0.8) wb_led_set(led[0],1);
  else wb_led_set(led[0],0);
  
  if(P > 0.8) wb_led_set(led[2],1);
  else wb_led_set(led[2],0);
}

int main(int argc, char **argv) {
  int i;
  char strP[20];
  double velocity, maxV = 0;

  /* necessary to initialize webots stuff */
  wb_robot_init();
  
  time_step = wb_robot_get_basic_time_step();
  
  /* Initialize Motors */
  left_motor = wb_robot_get_device("left wheel motor");
  right_motor = wb_robot_get_device("right wheel motor");
  wb_motor_set_position(left_motor, INFINITY);
  wb_motor_set_position(right_motor, INFINITY);
  wb_motor_set_velocity(left_motor, 0.0);
  wb_motor_set_velocity(right_motor, 0.0);

  /* Initialize IR Ground Sensors */
  char name[20];
  for (i = 0; i <8; i++){
    sprintf(name,"gs%d",i);
    gs[i] = wb_robot_get_device(name);
    wb_distance_sensor_enable(gs[i],time_step);
  }

  /* Initialize camera */
  WbDeviceTag camera = wb_robot_get_device("camera");
  wb_camera_enable(camera, time_step);

  /* Initialize LEDs */
  for (i = 0; i < 5; i++){
    sprintf(name, "led%d",i);
    led[i] = wb_robot_get_device(name);
    wb_led_set(led[i],1); // Turn on all LEDs
  }

  /* main loop */
  while (wb_robot_step(time_step) != -1) {

    LineFollowingModule();
    
    PosLED();
    
    wb_motor_set_velocity(left_motor, left_speed);
    wb_motor_set_velocity(right_motor, right_speed);
    
    robotX = wb_supervisor_node_get_self();
    
    const double *vel0 = wb_supervisor_node_get_velocity(robotX);
    
    velocity = sqrt(pow(vel0[0],2) + pow(vel0[1],2) + pow(vel0[2], 2));
    if (velocity > maxV) maxV = (velocity + maxV)/2;
    
    sprintf(strP,"Speed: %.2f m/s  Max: %.2f m/s",velocity,maxV);
    
    if(robotX == wb_supervisor_node_get_from_def("SLFR_V5A")){
      wb_supervisor_set_label(0,strP,0,0.97,0.05,0x165282,0,"Lucida Console");
    }
    if(robotX == wb_supervisor_node_get_from_def("SLFR_V5B")){
      wb_supervisor_set_label(0,strP,0,0.94,0.05,0x292933,0,"Lucida Console");
    }
  }

  wb_robot_cleanup();

  return 0;
}
