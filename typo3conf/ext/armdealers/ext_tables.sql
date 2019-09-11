#
# Table structure for table 'tx_armdealers_domain_model_dealer'
#
CREATE TABLE tx_armdealers_domain_model_dealer (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    title varchar(150) DEFAULT '' NOT NULL,
    street varchar(150) DEFAULT '' NOT NULL,
    zip varchar(10) DEFAULT '' NOT NULL,
    city varchar(75) DEFAULT '' NOT NULL,
    phone varchar(50) DEFAULT '' NOT NULL,
    email varchar(75) DEFAULT '' NOT NULL,
    lat double(9,6) DEFAULT '0.00' NOT NULL,
    lng double(9,6) DEFAULT '0.00' NOT NULL,
    zipcodes int(11) unsigned DEFAULT '0' NOT NULL,
    dealerpg int(11) unsigned DEFAULT '0' NOT NULL,
    pgurl varchar(250) DEFAULT '' NOT NULL,
    contactpid int(11) unsigned DEFAULT '0' NOT NULL,
    country varchar(50) DEFAULT '' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
    hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),

);

#
# Table structure for table 'tx_armdealers_domain_model_zipcode'
#
CREATE TABLE tx_armdealers_domain_model_zipcode (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    dealer int(11) DEFAULT '0' NOT NULL,
    zipcode smallint(4) DEFAULT '0' NOT NULL,
    city varchar(250) DEFAULT '' NOT NULL,
    canton char(2) DEFAULT '' NOT NULL,
    country char(3) DEFAULT 'CHE' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
    hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),

);

