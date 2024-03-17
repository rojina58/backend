create TABLE users(
    id bigint not null AUTO_INCREMENT,
    name varchar(50) not null,
    email varchar(120) not null,
    password varchar(30) not null,
    avatar varchar(500) DEFAULT null,
    PRIMARY KEY(id)
)

create TABLE company(
                        id bigint not null AUTO_INCREMENT,
                        title varchar(255) not null,
                        slogan varchar(255) DEFAULT null,
                        description varchar(2000) DEFAULT null,
                        email varchar(255) not null,
                        secondary_email varchar(255) DEFAULT null,
                        address varchar(1000) DEFAULT null,
                        secondary_address varchar(1000) DEFAULT null,
                        phone varchar(20) not null,
                        secondary_phone varchar(20) DEFAULT null,
                        logo varchar(255) DEFAULT null,
                        secondary_logo varchar(255) DEFAULT null,
                        facebook_url varchar(500) DEFAULT null,
                        twitter_url varchar(500) DEFAULT null,
                        instagram_url varchar(500) DEFAULT null,
                        snapchat_url varchar(500) DEFAULT null,
                        meta_title varchar(500) DEFAULT null,
                        meta_description varchar(1000) DEFAULT null,
                        meta_keywords varchar(1000) default null,
                        PRIMARY KEY(id)

)