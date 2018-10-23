## Installation

### Install TestCron plugin
Start at your ILIAS root directory 

```
mkdir -p Customizing/global/plugins/Services/Cron/CronHook
cd Customizing/global/plugins/Services/Cron/CronHook
git clone git@github.com:tomaszkolonko/TestCron.git
```

### Install dependencies via composer
```
cd TestCron
composer install
```

If you run composer from vagrant box, remember to run it as user `www-data`.
```
sudo -u www-data composer install
```
