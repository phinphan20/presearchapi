# presearchapi
Presearch API - Vultr API - CoinMarketCap API

Using Vultr you have to allow your web servers IP access to the API.
Using shared hosting sometimes the IP address you see in cPanel etc… is not the real server IP, best way to make sure you are using the correct IP for the API is to use this code on your web server.

You can use the ip.php file to get your shared hosting IP address.

Vultr
Login to your Vultr account — Go to Account then click on API. You will see your API key and the allowed list of IP addresses, paste your IP into the box also in the box where it says “32” enter 32 in there as well.  While you are on this page, you can copy your Vultr API and paste it into your code.

Presearch
Login to your Presearch node dashboard. https://nodes.presearch.org/dashboard
Click on the stats button at the bottom of the page, your API key will be listed at the bottom of the page.

The api.php file uses three API providers, Presearch, Vultr, and CoinMarketCap.  You will need to copy and paste in your API keys for the code to work properly.  Each spot is labeled in the api.php file where you need to paste the keys.

ALERT CODE

The alert code is designed to be run from a cron job at whatever inteval you would like.  This command would be for every 30 minutes:

0,30	*	*	*	*

If an alert is triggered, you can send an email and/or a text message.

The email code is written to work with MailJet, any mail provider could be used (Sendgrid, mailgun, etc...)

The text code is written to use Twilio.

The email and text code is provided as an example, although it does work and you can use both these services for small number of sends usually for free.

I am running my alerts from a GoDaddy hosting service, so it is off the my node server so if it is down I can still get alerts.
