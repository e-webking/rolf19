#
# Table structure for table 'tx_armip2location_domain_model_ip'
#
CREATE TABLE tx_armip2location_domain_model_ip (

    uid int(11) unsigned NOT NULL auto_increment,
    pid int(11) DEFAULT '0' NOT NULL,

    ipstart bigint(11) unsigned DEFAULT '0' NOT NULL,
    ipend bigint(11) unsigned DEFAULT '0' NOT NULL,
    cn2iso char(2) DEFAULT '0' NOT NULL,
    country varchar(250) DEFAULT '' NOT NULL,

    tstamp int(11) unsigned DEFAULT '0' NOT NULL,
    crdate int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id int(11) unsigned DEFAULT '0' NOT NULL,
    deleted smallint(5) unsigned DEFAULT '0' NOT NULL,
    hidden smallint(5) unsigned DEFAULT '0' NOT NULL,

    PRIMARY KEY (uid),
    KEY parent (pid),
);