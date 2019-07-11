#!/bin/bash
ver=$(echo "v1.0")
port=$(echo "9900")
portbe=$(echo "9999")
name=$(echo "TermuxYoloTool")
description=$(echo "TermuxYoloTool allow you to use your phone for betting on YoloDice using EarnWallet scripts!\nWe will start web server in few seconds, please wait and answer questions asked by code.")
echo "🔥➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖🔥";
echo "🔥Earn Wallet Tool 🔥";
echo "🔥Name: $name";
echo "🔥Description: $description"
echo "🔥➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖➖🔥";
sleep 10;
echo "Starting server on 127.0.0.1:$port <--- open this in browser to see gui.";
sleep 5;
cd php;
php -S 127.0.0.1:$port &
sleep 5;
echo "Starting server."
cd ..
cd node
npm install 
node index.js $portbe
killall php
exit