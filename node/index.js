const prompts = require('prompts');
prompts.override(require('yargs').argv);
const express = require('express')
const app = express()
const cors = require('cors')
const port = process.argv[2];
console.log("======== L O A D I N G ========");
console.log(" - PORT: "+port);

(async () => {
  const response = await prompts([
    {
      type: 'text',
      name: 'name',
      message: `For a good start, what's your name?`
    },
    {
      type: 'password',
      name: 'password',
      message: `Please input password that you will use to access bot.`
    },
    {
      type: 'text',
      name: 'yolodice',
      message: `Please input your YoloDice API priv key.`
    },
    {
      type: 'select',
      name: 'coin',
      message: 'Please select coin',
      choices: [
        { title: 'Dogecoin (DOGE)', value: 'doge' },
        { title: 'Bitcoin (BTC)', value: 'btc' },
        { title: 'Litecoin (LTC)', value: 'ltc' },
        { title: 'Ethereum (ETH)', value: 'eth' }
      ],
      initial: 1
    },
    {
      type: 'confirm',
      name: 'confirm',
      message: 'Do you know what @EarnWallet is?'
    }
  ]);
  if (!response.confirm) {
    console.log(`=========
Oh! @EarnWallet is awesome community for people who want to earn cryptocurrency, talk, have fun and earn money! You should visit it!
Telegram channel: http://t.me/EarnWalletChannel
Telegram Group: http://t.me/EarnWalletChat

All things published there are free to use, because if something works why you should pay for it?
I'll never understand it.
=========`);
  }
  coin = response.coin
  password = response.password;
  username = response.name;
  yolodice = response.yolodice;
  app.use(cors())
  app.get('/create_bet', (req, res) => {
    if (req.query.pass == password) {
      client.send({
        method: 'create_bet',
        params: {
          attrs: {
            "coin": coin,
            "amount": req.query.amount,
            "target": req.query.target,
            "range": req.query.range
          },
          include_datas: true
        }
      }, function (resp) {
        res.status(200)
        res.send(JSON.stringify(resp));
        
      });
    } else {
      res.status(200)
      res.send("Password incorrect.");
    }
    //res.status(500).send('Uh!');
  })
  app.listen(port, () => console.log(`API v1.0 is listening on ${port}`))
  YOLOdice = require('yolodice-api');
  client = new YOLOdice(yolodice);
  client.on('loggedIn', (user) => {
    console.log(`Hey ${ username }, You have successyfully logged in as (${user.id})${user.name}!`);
  });
  client.on('error', (err) => {
    console.dir(err);
  }); 
  process.on('SIGINT', () => {
    client.quit();
  });
  attrs = {
    "coin": coin,
    "amount": 0,
    "target": 500000,
    "range": 'lo'
  }
  setTimeout(() => { console.log(`PORT: ${port}`) },5000)
})();