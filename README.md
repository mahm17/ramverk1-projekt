# ramverk1-projekt
[![CircleCI](https://circleci.com/gh/mahm17/ramverk1-projekt.svg?style=svg)](https://circleci.com/gh/mahm17/ramverk1-projekt)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mahm17/ramverk1-projekt/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mahm17/ramverk1-projekt/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/mahm17/ramverk1-projekt/badges/build.png?b=master)](https://scrutinizer-ci.com/g/mahm17/ramverk1-projekt/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/mahm17/ramverk1-projekt/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

Copy the repo to your own folder
----------------

```
git clone git@github.com:mahm17/ramverk1-projekt.git your_folder
```

Create the database file
--------

```
mkdir data
touch data/db.sqlite
```

Create the tables for the database
----------------------

```
sqlite3 data/db.sqlite < sql/ddl/user_sqlite.sql
```
