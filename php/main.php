<?php
$url = "http://".$_GET['ip'].":".$_GET['port']."/create_bet?amount=0&target=500000&range=lo&pass=".$_GET['password'];
echo $url.PHP_EOL;
$req = file_get_contents($url);
if ($req == "Password incorrect.") {
  echo "Incorrect password";
  return 0;
}
?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<p id="p">Stats</p>
<script>
$.get("<?php echo $url; ?>")
.done(function( data ) { 
  dobet(data); 
});
let under = [
    1,
    99.00,
    49.50,
    33.00,
    24.75,
    19.80,
    16.50,
    14.14,
    12.38,
    11.00,
    9.90,
    9.00,
    8.25,
    7.62,
    7.07,
    6.60,
    6.19,
    5.82,
    5.50,
    5.21,
    4.95,
    4.71,
    4.50,
    4.30,
    4.13,
    3.96,
    3.81,
    3.67,
    3.54,
    3.41,
    3.30,
    3.19,
    3.09,
    3.00,
    2.91,
    2.83,
    2.75,
    2.68,
    2.61,
    2.54,
    2.48,
    2.41,
    2.36,
    2.30,
    2.25,
    2.20,
    2.15,
    2.11,
    2.06,
    2.02,
    1.98,
    1.94,
    1.90,
    1.87,
    1.83,
    1.80,
    1.77,
    1.74,
    1.71,
    1.68,
    1.65,
    1.62,
    1.60,
    1.57,
    1.55,
    1.52,
    1.50,
    1.48,
    1.46,
    1.43,
    1.41,
    1.39,
    1.38,
    1.36,
    1.34,
    1.32,
    1.30,
    1.29,
    1.27,
    1.25,
    1.24,
    1.22,
    1.21,
    1.19,
    1.18,
    1.16,
    1.15,
    1.14,
    1.13,
    1.11,
    1.10,
    1.09,
    1.08,
    1.06,
    1.05,
    1.04,
    1.03,
    1.02,
    1.01
]
global = [];
global['previousbet'] = 0
global["winningstreak"] = 0
function dobet(data) {
  data = JSON.parse(data)
  chance = Number(Number(Math.random())*100).toFixed(0);
  profit = Number(data.result.profit);
  balance = Number(data.result.user_coin_data.balance)
  base = Number(balance/314000).toFixed(0)
  win = data.result.win
  delay = data.delay;
  document.body.innerHTML = "This is just preview, to show that this tool is working, although strategy inside is good find some better way to run it. @EarnWalletDev<br />Example request url: <?php echo $url; ?><br /><b>Balance: "+Number(balance/1e8).toFixed(8)+" BaseBet: "+base+" Bet: "+global['previousbet']+" Streak: "+global['winningstreak']+" Profit: "+global['profit']+"</b>";
  // result
  if (win) {
    nextbet = base;
  } else {
    nextbet = Number(global['profit'])*-1*under[chance]
    chance = chance;
  }
  if (nextbet == 0) {
    nextbet = base;
  }
  if (global["winningstreak"] >= 0 && !win) {
    global["winningstreak"] = 0
  }
  if (global["winningstreak"] <= 0 && win) {
    global["winningstreak"] = 0
  }
  if (win) {
    global["winningstreak"]++;
  }
  if (!win) {
    global["winningstreak"]--;
  }
  global['previousbet'] = nextbet
  nextbet = Number(nextbet).toFixed(0)
  document.body.innerHTML = "Balance: "+Number(balance/1e8).toFixed(8)+" BaseBet: "+base+" Bet: "+nextbet+" Chance:"+chance;
  $.get("http://<?php echo $_GET['ip'];?>:<?php echo $_GET['port']; ?>/create_bet?amount="+nextbet+"&target="+chance*10000+"&range=lo&pass=<?php echo $_GET['password']; ?>")
  .done(function( data ) { 
    setTimeout(() => {dobet(data)},delay*10); 
  });
}
</script>