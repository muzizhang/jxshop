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
    goods_name VARCHAR(255) not null comment '商品名称',
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


-- RBAC
drop table if exists privilege;
create TABLE privilege
(
    id int unsigned not null auto_increment comment 'ID',
    pri_name VARCHAR(255) not null comment '权限名称',
    url_path VARCHAR(255) not null comment '对应的URL地址，多个地址用,隔开',
    parent_id int unsigned not null DEFAULT '0' comment '上级id',
    primary key (id)
)engine='InnoDB' comment='权限表';

insert into privilege VALUES
(1,'商品模块','',0),
    (2,'品牌管理','brand/index,',1),
        (3,'添加品牌','brand/create,brand/add',2),
        (4,'修改品牌','brand/edit,brand/modify',2),
        (5,'删除品牌','brand/delete',2),
    (6,'商品管理','goods/index,',1),
        (7,'添加商品','goods/create,goods/add',6),
        (8,'修改商品','goods/edit,goods/modify',6),
        (9,'删除商品','goods/delete',6);


insert into privilege(id,pri_name,url_path,parent_id) VALUES
(1,'商品模块','',0),
    (2,'分类列表','category/index',1),
        (3,'添加分类','category/create,category/add',2),
        (4,'修改分类','category/edit,category/modify',2),
        (5,'删除分类','category/delete',2),
    (6,'品牌列表','brand/index',1),
        (7,'添加品牌','brand/create,brand/add',6),
        (8,'修改品牌','brand/edit,brand/modify',6),
        (9,'删除品牌','brand/delete',6),
    (10,'商品列表','goods/index',1),
        (11,'添加商品','goods/create,goods/add',10),
        (12,'修改商品','goods/edit,goods/modify',10),
        (13,'删除商品','goods/delete',10),
        (36,'AJAX获取分类','goods/ajax_get_cat',10),
(14,'管理员模块','',0),
    (15,'权限列表','privilege/index',14),
        (16,'添加权限','privilege/create,privilege/add',15),
        (17,'修改权限','privilege/edit,privilege/modify',15),
        (18,'删除权限','privilege/delete',15),
    (19,'角色列表','role/index',14),
        (20,'添加角色','role/create,role/add',19),
        (21,'修改角色','role/edit,role/modify',19),
        (22,'删除角色','role/delete',19),
    (23,'管理员列表','admin/index',14),
        (24,'添加管理员','admin/create,admin/add',23),
        (25,'修改管理员','admin/edit,admin/modify',23),
        (26,'删除管理员','admin/delete',23),
(27,'文章模块','',0),
    (28,'分类列表','Article_category/index',27),
        (29,'添加分类','article_category/create,article_category/add',28),
        (30,'修改分类','article_category/edit,article_category/modify',28),
        (31,'删除分类','article_category/delete',28),
    (32,'文章列表','article/index',27),
        (33,'添加文章','article/create,article/add',32),
        (34,'修改文章','article/edit,article/modify',32),
        (35,'删除文章','article/delete',32);

-- 地址     goods/create,goods/add

drop table if exists role_privilege;
create TABLE role_privilege
(
    pri_id int unsigned not null comment '权限ID',
    role_id int unsigned not null comment '角色ID',
    key pri_id(pri_id),
    key role_id(role_id)
)engine='InnoDB' comment='角色权限表';

insert into role_privilege VALUES
(2,2),
(3,2),
(4,2),
(5,2),
(1,3),
(2,3),
(3,3),
(4,3),
(5,3),
(6,3),
(7,3),
(8,3),
(9,3);


drop table if exists role;
create TABLE role
(
    id int unsigned not null auto_increment comment 'ID',
    role_name VARCHAR(255) not null comment '角色名称',
    primary key (id)
)engine='InnoDB' comment='角色表';

insert into role VALUES
(1,'超级管理员'),
(2,'品牌编辑'),
(3,'商品总监');


drop table if exists role_admin;
create TABLE role_admin
(
    role_id int unsigned not null comment '角色ID',
    admin_id int unsigned not null comment '管理ID',
    key admin_id(admin_id),
    key role_id(role_id)
)engine='InnoDB' comment='角色管理表';

insert into role_admin VALUES
(1,1),
(3,2),
(2,3);

drop table if exists admin;
create table admin
(
    id int unsigned not null auto_increment comment 'ID',
    user_name VARCHAR(255) not null comment '管理员名称',
    password VARCHAR(255) not null comment '密码',
    primary key (id)
)engine='InnoDB' comment='管理员表';

insert into admin VALUES
(1,'root','21232f297a57a5a743894a0e4a801fc3'),
(2,'tom','21232f297a57a5a743894a0e4a801fc3'),
(3,'jack','21232f297a57a5a743894a0e4a801fc3');


drop table if exists article_category;
create table article_category
(
    id int unsigned not null auto_increment comment 'ID',
    cat_name VARCHAR(255) not null comment '分类名称',
    primary key (id)
)engine='InnoDB' comment='文章分类表';

drop table if exists article;
create table article
(
    id int unsigned not null auto_increment comment 'ID',
    title VARCHAR(255) not null comment '标题',
    content longtext comment '内容',
    created_at datetime not null default CURRENT_TIMESTAMP comment '创建时间',
    link VARCHAR(255) comment '链接地址',
    article_category_id int unsigned not null comment '分类id',
    primary key (id)
)engine='InnoDB' comment='文章表';