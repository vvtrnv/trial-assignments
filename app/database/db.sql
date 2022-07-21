CREATE DATABASE store;

USE store;

CREATE TABLE product
(
    product_id INT AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    description text,
    is_active boolean DEFAULT true,

    CONSTRAINT product_pk PRIMARY KEY(product_id)
);

CREATE TABLE images
(
    product_id INT NOT NULL,
    image_id INT NOT NULL,
    is_main boolean DEFAULT false,

    CONSTRAINT images_pk PRIMARY KEY (product_id, image_id)
);

CREATE TABLE image
(
    image_id INT AUTO_INCREMENT,
    path varchar(255) NOT NULL,
    alt varchar(255),

    CONSTRAINT image_pk PRIMARY KEY(image_id)
);

# ------ Install FK on table images
ALTER TABLE images
    ADD CONSTRAINT images_image_fk
    FOREIGN KEY(image_id) REFERENCES image(image_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;

ALTER TABLE images
    ADD CONSTRAINT images_product_fk
    FOREIGN KEY(product_id) REFERENCES product(product_id)
    ON DELETE CASCADE
    ON UPDATE CASCADE;
# ------

CREATE TABLE prices
(
    product_id INT UNIQUE NOT NULL,
    price decimal(8,2) NOT NULL,
    price_with_sale decimal(8,2),
    price_with_promo decimal(8,2),

    CONSTRAINT prices_product_fk
        FOREIGN KEY (product_id)
        REFERENCES product(product_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CHECK (price >= 0 AND price_with_sale >= 0 AND price_with_promo >= 0)
);

CREATE TABLE category
(
    category_id INT AUTO_INCREMENT,
    parent_category_id INT,
    name varchar(255),
    description text,

    CONSTRAINT category_pk PRIMARY KEY (category_id),

    CONSTRAINT category_category_fk
        FOREIGN KEY (parent_category_id)
        REFERENCES category(category_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

CREATE TABLE product_categories
(
    product_id INT NOT NULL,
    category_id INT NOT NULL,
    is_main_category boolean DEFAULT false,

    CONSTRAINT pc_pk PRIMARY KEY (product_id, category_id),

    CONSTRAINT pc_product_fk
        FOREIGN KEY (product_id)
        REFERENCES product(product_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT pc_category_fk
        FOREIGN KEY (category_id)
        REFERENCES category(category_id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

# ------ Fill table category
INSERT INTO category(name, description)
    VALUE ('Рубашки', 'Lorem ipsum dolor sit amet, urpis sagittis lorem');

INSERT INTO category(parent_category_id, name, description)
    VALUES (1, 'Рубашки Medicine', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'),
           (2, 'Все модели Medicine', 'Lorem ipsum dolor sit amet, consectetur');

INSERT INTO category(name, description)
    VALUE ('Джинсы', 'Lorem ipsum dolor');

INSERT INTO category(parent_category_id, name)
    VALUE (4, 'Джинсы Levi`s');
# ------

# ------ Fill table product
INSERT INTO product(name, description, is_active)
    VALUES ('Рубашка Medicine',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 1',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 2',
            'text',
            false),
           ('Рубашка Medicine 3',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 4',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 5',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 6',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 7',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 8',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 9',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 10',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 11',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 12',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true),
           ('Рубашка Medicine 13',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            true);

INSERT INTO product(name, description, is_active)
    VALUES ('Рубашка обычная',
            ' Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 1',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 2',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 3',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 4',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 5',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 6',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 7',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 8',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 9',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 10',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 11',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true),
           ('Рубашка обычная 12',
            'Ut sed rutrum lectus, quis facilisis ex.',
            true);

INSERT INTO product(name, description, is_active)
    VALUES ('Джинсы Levi`s',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 1',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 2',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 3',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 4',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 5',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 6',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 7',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 8',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 9',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 10',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 11',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 12',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true),
           ('Джинсы Levi`s 13',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            false),
           ('Джинсы Levi`s 14',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            false),
           ('Джинсы Levi`s 15',
            'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor',
            true);
# ------

# ------ Fill table image
INSERT INTO image(path, alt)
    VALUES ('img/photos/img1.png', 'Зелёная Рубашка Medicine на белом фоне'),
           ('img/photos/img2.png', 'Девушка в зелёной рубашке Medicine в полный рост'),
           ('img/photos/img3.png', 'Девушка в зелёной рубашке Medicine'),
           ('img/photos/img4.png', 'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor'),
           ('img/photos/img5.png', 'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor'),
           ('img/photos/img6.png', 'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor'),
           ('img/photos/img7.png', 'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor'),
           ('img/photos/img8.png', 'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor'),
           ('img/photos/img9.png', 'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor'),
           ('img/photos/img10.png', 'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor'),
           ('img/photos/img11.png', 'Lorem ipsum dolor lorem ipsum dolor lorem ipsum dolor');
# ------

# ------ Fill table images
INSERT INTO images(product_id, image_id, is_main)
    VALUES (1, 1, true),
           (1, 2, false),
           (1, 3, false),
           (2, 1, true),
           (2, 2, false),
           (2, 3, false),
           (3, 1, true),
           (3, 2, false),
           (3, 3, false),
           (4, 1, true),
           (4, 2, false),
           (4, 3, false),
           (5, 1, true),
           (5, 2, false),
           (5, 3, false),
           (6, 1, true),
           (6, 2, false),
           (6, 3, false),
           (7, 1, true),
           (7, 2, false),
           (7, 3, false),
           (8, 1, true),
           (8, 2, false),
           (8, 3, false),
           (9, 1, true),
           (9, 2, false),
           (9, 3, false),
           (10, 1, true),
           (10, 2, false),
           (10, 3, false),
           (11, 1, true),
           (11, 2, false),
           (11, 3, false),
           (12, 1, true),
           (12, 2, false),
           (12, 3, false),
           (13, 1, true),
           (13, 2, false),
           (13, 3, false),
           (14, 1, true),
           (14, 2, false),
           (14, 3, false);

INSERT INTO images(product_id, image_id, is_main)
    VALUES (15, 4, true),
           (15, 5, false),
           (15, 6, false),
           (16, 4, true),
           (16, 5, false),
           (16, 6, false),
           (17, 4, true),
           (17, 5, false),
           (17, 6, false),
           (18, 4, true),
           (18, 5, false),
           (18, 6, false),
           (19, 4, true),
           (19, 5, false),
           (19, 6, false),
           (20, 4, true),
           (20, 5, false),
           (20, 6, false),
           (21, 4, true),
           (21, 5, false),
           (21, 6, false),
           (22, 4, true),
           (22, 5, false),
           (22, 6, false),
           (23, 4, true),
           (23, 5, false),
           (23, 6, false),
           (24, 4, true),
           (24, 5, false),
           (24, 6, false),
           (25, 4, true),
           (25, 5, false),
           (25, 6, false),
           (26, 4, true),
           (26, 5, false),
           (26, 6, false),
           (27, 4, true),
           (27, 5, false),
           (27, 6, false);

INSERT INTO images(product_id, image_id, is_main)
    VALUES (28, 7, true),
           (28, 8, false),
           (29, 7, true),
           (29, 8, false),
           (30, 7, true),
           (30, 8, false),
           (31, 7, true),
           (31, 8, false),
           (32, 7, true),
           (32, 8, false),
           (33, 7, true),
           (33, 8, false),
           (34, 7, true),
           (34, 8, false),
           (35, 7, true),
           (35, 8, false);

INSERT INTO images(product_id, image_id, is_main)
        VALUES (36, 9, true),
               (36, 10, false),
               (36, 11, false),
               (37, 9, true),
               (37, 10, false),
               (37, 11, false),
               (38, 9, true),
               (38, 10, false),
               (38, 11, false),
               (39, 9, true),
               (39, 10, false),
               (39, 11, false),
               (40, 9, true),
               (40, 10, false),
               (40, 11, false),
               (41, 9, true),
               (41, 10, false),
               (41, 11, false),
               (42, 9, true),
               (42, 10, false),
               (42, 11, false),
               (43, 9, true),
               (43, 10, false),
               (43, 11, false);
# ------

# ------ Fill table product_categories
INSERT INTO product_categories(product_id, category_id, is_main_category)
    VALUES (1, 2, true),
           (1, 1, false),
           (1, 3, false),
           (2, 2, true),
           (2, 1, false),
           (2, 3, false),
           (3, 2, true),
           (3, 1, false),
           (3, 3, false),
           (4, 2, true),
           (4, 1, false),
           (4, 3, false),
           (5, 2, true),
           (5, 1, false),
           (5, 3, false),
           (6, 2, true),
           (6, 1, false),
           (6, 3, false),
           (7, 2, true),
           (7, 1, false),
           (7, 3, false),
           (8, 2, true),
           (8, 1, false),
           (8, 3, false),
           (9, 2, true),
           (9, 1, false),
           (9, 3, false),
           (10, 2, true),
           (10, 1, false),
           (10, 3, false),
           (11, 2, true),
           (11, 1, false),
           (11, 3, false),
           (12, 2, true),
           (12, 1, false),
           (12, 3, false),
           (13, 2, true),
           (13, 1, false),
           (13, 3, false),
           (14, 2, true),
           (14, 1, false),
           (14, 3, false),
           (15, 1, true),
           (16, 1, true),
           (17, 1, true),
           (18, 1, true),
           (19, 1, true),
           (20, 1, true),
           (21, 1, true),
           (22, 1, true),
           (23, 1, true),
           (24, 1, true),
           (25, 1, true),
           (26, 1, true),
           (27, 1, true),
           (28, 5, true),
           (28, 4, false),
           (29, 5, true),
           (29, 4, false),
           (30, 5, true),
           (30, 4, false),
           (31, 5, true),
           (31, 4, false),
           (32, 5, true),
           (32, 4, false),
           (33, 5, true),
           (33, 4, false),
           (34, 5, true),
           (34, 4, false),
           (35, 5, true),
           (35, 4, false),
           (36, 5, true),
           (36, 4, false),
           (37, 5, true),
           (37, 4, false),
           (38, 5, true),
           (38, 4, false),
           (39, 5, true),
           (39, 4, false),
           (40, 5, true),
           (40, 4, false),
           (41, 5, true),
           (41, 4, false),
           (42, 5, true),
           (42, 4, false),
           (43, 5, true),
           (43, 4, false);
# ------

# ------ Fill table prices
INSERT INTO prices(product_id, price, price_with_sale, price_with_promo)
    VALUES (1, 2666, 2499, 2227),
           (2, 2666, 2499, 2227),
           (3, 2666, 2499, 2227),
           (4, 2666, 2499, 2227),
           (5, 2666, 2499, 2227),
           (6, 2666, 2499, 2227),
           (7, 2666, 2499, 2227),
           (8, 2666, 2499, 2227),
           (9, 2666, 2499, 2227),
           (10, 2666, 2499, 2227),
           (11, 2666, 2499, 2227),
           (12, 2666, 2499, 2227),
           (13, 2666, 2499, 2227),
           (14, 2666, 2499, 2227),
           (15, 2666, 2499, 2227),
           (16, 2666, 2499, 2227),
           (17, 2666, 2499, 2227),
           (18, 2666, 2499, 2227),
           (19, 2666, 2499, 2227),
           (20, 2666, 2499, 2227),
           (21, 2666, 2499, 2227),
           (22, 2666, 2499, 2227),
           (23, 2666, 2499, 2227),
           (24, 2666, 2499, 2227),
           (25, 2666, 2499, 2227),
           (26, 2666, 2499, 2227),
           (27, 2666, 2499, 2227),
           (28, 2666, 2499, 2227),
           (29, 2666, 2499, 2227),
           (30, 2666, 2499, 2227),
           (31, 2666, 2499, 2227),
           (32, 2666, 2499, 2227),
           (33, 2666, 2499, 2227),
           (34, 2666, 2499, 2227),
           (35, 2666, 2499, 2227),
           (36, 2666, 2499, 2227),
           (37, 2666, 2499, 2227),
           (38, 2666, 2499, 2227),
           (39, 2666, 2499, 2227),
           (40, 2666, 2499, 2227),
           (41, 2666, 2499, 2227),
           (42, 2666, 2499, 2227),
           (43, 2666, 2499, 2227);
# ------
