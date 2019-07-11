apt update
apt upgrade -y
apt install curl nodejs php git -y
git clone https://github.com/earnwallet/YoloDiceTool_Termux yd
cd yd
chmod +x YoloScript.sh
cd ..
echo "Complete! to Start script use:\n\n\n\n\n\n\n"
echo "cd ~/yd; sh YoloScript.sh"
