#!/bin/bash

NAME=$1
wget http://192.168.12.1:9090/stream/snapshot.jpeg?delay_s=1 -O ../snapshots/$NAME
