#
# Table structure for table 'tx_armdealers_domain_model_category'
#

CREATE TABLE tx_armdealers_domain_model_category (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    title varchar(150) DEFAULT '' NOT NULL,
    products int(11) unsigned DEFAULT '0' NOT NULL,
    image int(11) unsigned DEFAULT '0' NOT NULL,
    pageuid int(11) unsigned DEFAULT '0' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
    hidden smallint(5) unsigned DEFAULT '0' NOT NULL,
    starttime int(11) unsigned DEFAULT '0' NOT NULL,
    endtime int(11) unsigned DEFAULT '0' NOT NULL,

    sys_language_uid int(11) DEFAULT '0' NOT NULL,
    l10n_parent int(11) DEFAULT '0' NOT NULL,
    l10n_diffsource mediumblob,

    PRIMARY KEY (uid),
    KEY parent (pid),
    KEY language (l10n_parent,sys_language_uid)
);

#
# Table structure for table 'tx_armdealers_domain_model_product'
#

CREATE TABLE tx_armdealers_domain_model_product (

	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,
	sku varchar(50) DEFAULT '' NOT NULL,
        category int(11) DEFAULT '0' NOT NULL,
	description text,
	coverphoto int(11) unsigned NOT NULL default '0',
	preview int(11) unsigned NOT NULL default '0',
        images int(11) unsigned NOT NULL default '0',
        pdf int(11) unsigned NOT NULL default '0',
        techpdf int(11) unsigned NOT NULL default '0',
        video int(11) unsigned NOT NULL default '0',
        mtitle varchar(255) DEFAULT '' NOT NULL,
        mdescription text,
        dealers int(11) unsigned NOT NULL default '0',

	tstamp int(11) unsigned DEFAULT '0' NOT NULL,
	crdate int(11) unsigned DEFAULT '0' NOT NULL,
	cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
	deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
	hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	starttime int(11) unsigned DEFAULT '0' NOT NULL,
	endtime int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	sys_language_uid int(11) DEFAULT '0' NOT NULL,
	l10n_parent int(11) DEFAULT '0' NOT NULL,
	l10n_diffsource mediumblob,

	PRIMARY KEY (uid),
	KEY parent (pid),
 	KEY language (l10n_parent,sys_language_uid)

);



#
# Table structure for table 'tx_armdealers_domain_model_productdealer'
#

CREATE TABLE tx_armdealers_domain_model_productdealer (
    
    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    product int(11) unsigned DEFAULT '0' NOT NULL, 
    dealer int(11) unsigned DEFAULT '0' NOT NULL,
    splprice tinyint(4) unsigned DEFAULT '0' NOT NULL,
    sorting int(11) unsigned DEFAULT '0' NOT NULL,

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
    dealerpg int(11) DEFAULT '0',
    pgurl varchar(250) DEFAULT '' NOT NULL,
    contactpid int(11) unsigned DEFAULT '0' NOT NULL,
    country varchar(50) DEFAULT '' NOT NULL,
    iso2cn char(2) DEFAULT '' NOT NULL,
    dispmsg varchar(250) DEFAULT '' NOT NULL,

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
    country varchar(50) DEFAULT 'CHE' NOT NULL,

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
# Table structure for table 'tx_armdealers_domain_model_rawdata'
#
CREATE TABLE tx_armdealers_domain_model_rawdata (

    uid int(11) NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,
    deleted smallint(5) unsigned DEFAULT '0' NOT NULL,

    dealertitel varchar(150) DEFAULT '' NOT NULL,
    adresse varchar(150) DEFAULT '' NOT NULL,
    postleitzahl varchar(10) DEFAULT '' NOT NULL,
    ort varchar(75) DEFAULT '' NOT NULL,
    iso2cn char(2) DEFAULT '' NOT NULL,
    land varchar(50) DEFAULT '' NOT NULL,
    telefon varchar(50) DEFAULT '' NOT NULL,
    email varchar(75) DEFAULT '' NOT NULL,
    lat double(9,6) DEFAULT '0.00' NOT NULL,
    lng double(9,6) DEFAULT '0.00' NOT NULL,
    formmsg varchar(250) DEFAULT '' NOT NULL,
    land2 varchar(50) DEFAULT '' NOT NULL,
    plz varchar(10) DEFAULT '' NOT NULL,
    ville varchar(75) DEFAULT '' NOT NULL,
    kanton varchar(150) DEFAULT '' NOT NULL,
    processed smallint(5) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
);