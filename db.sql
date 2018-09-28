-- 分类表
create table category
(
    id int(11) unsigned not null auto_increment comment 'ID',
    cat_name varchar(255) not null comment '分类名称',
    parent_id int unsigned not null default 0 comment '上级ID',
    path varchar(255) not null default "-" comment '所有上级分类的ID',
    primary key (id)
)engine='InnoDB' comment='分类表';


--  插入数据
INSERT INTO category VALUES
    (1,'家用电器',0,'-'),
        (3,'空调',1,'-1-'),
            (7,'柜式空调',3,'-1-3-'),
            (8,'中央空调',3,'-1-3-'),
        (4,'冰箱',1,'-1-'),
            (9,'多门',4,'-1-4-'),
            (10,'对门',4,'-1-4-'),
    (2,'电脑',0,'-'),
        (5,'电脑整机',2,'-2-'),
            (11,'笔记本',5,'-2-5-'),
            (12,'游戏本',5,'-2-5-'),
        (6,'电脑配件',2,'-2-'),
            (13,'显示器',5,'-2-6-'),
            (14,'CPU',5,'-2-6-');


-- 品牌表
create table brand
(
    id int unsigned not null auto_increment comment 'ID',
    brand_name varchar(255) not null comment '品牌名称',
    logo varchar(255) not null comment 'LOGO',
    primary key(id)
)engine='InnoDB' comment='品牌表';

--  商品表
create table goods
(
    id int unsigned not null auto_increment comment 'ID',
    goods_name varchar(255) not null comment '商品名称',
    logo varchar(255) not null comment 'LOGO',
    is_on_sale enum('y','n') not null default 'y' comment '是否上架',
    description longtext not null comment '商品描述',
    cat1_id int unsigned not null comment '一级分类ID',
    cat2_id int unsigned not null comment '二级分类ID',
    cat3_id int unsigned not null comment '三级分类ID',
    brand_id int unsigned not null comment '品牌ID',
    created_at datetime not null default CURRENT_TIMESTAMP comment '添加时间',
    primary key(id)
)engine='InnoDB' comment='商品表';

--  商品属性表
create table goods_attribute
(
    id int unsigned not null auto_increment comment 'ID',
    attr_name varchar(255) not null comment '属性名称',
    attr_value varchar(255) not null comment '属性值',
    goods_id int unsigned not null comment '所属的商品ID',
    primary key (id)
)engine='InnoDB' comment='商品属性表';

--  商品图片表
create table goods_image
(
    id int unsigned not null auto_increment comment 'ID',
    path varchar(255) not null comment '图片路径',
    goods_id int unsigned not null comment '所属的商品ID',
    primary key (id)
)engine='InnoDB' comment='商品图片表';
--  商品sku表
create table goods_sku
(
    id int unsigned not null auto_increment comment 'ID',
    sku_name varchar(255) not null comment 'SKU名称', 
    stock int unsigned not null comment '库存量',
    price decimal(10,2) not null comment '价格',
    goods_id int unsigned not null comment '所属的商品ID',
    primary key (id)
)engine='InnoDB' comment='商品sku表';