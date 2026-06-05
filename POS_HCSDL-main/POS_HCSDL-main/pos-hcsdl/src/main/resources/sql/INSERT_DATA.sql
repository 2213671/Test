insert ignore into roles (id, role_name)
values ('af15acc9-70e4-4713-b3a4-301a46e45425', 'ADMIN'),
       ('2e7fe949-234c-43d6-b37e-d88f6f895b1e', 'STAFF'),
       ('15809f57-56cb-4eb3-a09f-361e69704864', 'ADMIN_RESTAURANT');

insert into users(id, username, password, image_url, role_id)
values ('cddf0ccd-7f55-4c67-9c1f-d625d579d76a', 'admin', '$2a$10$2xgaugXbk2fHsr1Rp5WbkOb05XVDn16Tk4ItlEq.29SPKB63xCgi2',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'af15acc9-70e4-4713-b3a4-301a46e45425')

insert into restaurants(id,
                        name,
                        description,
                        address,
                        email,
                        image_url,
                        status)
values ('5edea57e-6226-4072-8ea6-401e47e6e240',
        'Nhà hàng Hoàn Phát',
        'Nhà hàng chuyên phục vụ các món Á – Âu, không gian sang trọng và dịch vụ chuyên nghiệp.',
        '123 Đường Lê Lợi, Quận 1, TP. Hồ Chí Minh',
        'contact@hoanphatrestaurant.com',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE');

insert into users (id,
                   username,
                   password,
                   email,
                   image_url,
                   address,
                   phone,
                   role_id,
                   restaurant_id)
values ('dec657be-f59e-490b-9ba7-0df75ccb1995',
        'hoanphat',
        '$2a$10$XSbqYdQB0hEg3IB73dbnve4s9J0yn.3Itvc/yoohwUz56jgB58V5S',
        '',
        '',
        '',
        '',
        '15809f57-56cb-4eb3-a09f-361e69704864',
        '5edea57e-6226-4072-8ea6-401e47e6e240');

insert into restaurant_tables (id, name, status, restaurant_id)
values ('b1c7a3a1-2c41-4f9e-bc76-1f0e77ede101', 'Bàn 1', 'BLANK', '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('e0a9c892-3fd7-4ba8-b1d7-2a1d80d7a202', 'Bàn 2', 'BLANK', '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('f82ce3f0-b2d2-4f38-a739-3b27d9afc303', 'Bàn 3', 'BLANK', '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('a6fbcb43-4e95-4e70-8a77-4d31cefac404', 'Bàn 4', 'BLANK', '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('c0f3f7bb-55db-4b2e-9edf-5b42e4abc505', 'Bàn 5', 'BLANK', '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('d5c3f6d1-6ad8-42f0-9436-6c53f8bcd606', 'Bàn 6', 'BLANK', '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('e9a2dfed-7b3e-4ab3-9af4-7d64fabc7707', 'Bàn 7', 'BLANK', '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('fa1c0d21-8c42-4dc6-a8f2-8e75fcbd8808', 'Bàn 8', 'BLANK', '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('ab3f7c41-9d23-4b3a-9e77-9f86abcd9909', 'Bàn 9', 'BLANK', '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('cd4e8a52-af34-4ed9-8c66-af97bcadea10', 'Bàn 10', 'BLANK', '5edea57e-6226-4072-8ea6-401e47e6e240');

insert into menus (id, name, description, status, restaurant_id)
values ('cf7a5b21-94d4-4a22-8d33-101adbe90101',
        'Khai Vị',
        'Các món khai vị nhẹ, thích hợp mở đầu bữa ăn.',
        'ACTIVE',
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('d0a2b732-a51c-4f5a-8ee0-202bdce90202',
        'Món Chính',
        'Các món chính Á – Âu được chế biến đặc biệt.',
        'ACTIVE',
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('e1b3c843-b62d-4c6f-9ff1-303cdfe90303',
        'Tráng Miệng',
        'Các món ngọt, trái cây và bánh dành cho tráng miệng.',
        'ACTIVE',
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('f2c4d954-c73e-4d70-af01-404defea0404',
        'Đồ Uống',
        'Nước ngọt, cà phê, trà và thức uống có cồn.',
        'ACTIVE',
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('a3d5ea65-d84f-4e81-b102-505effeb0505',
        'Combo Đặc Biệt',
        'Combo tiết kiệm gồm khai vị, món chính và tráng miệng.',
        'ACTIVE',
        '5edea57e-6226-4072-8ea6-401e47e6e240');

insert into toppings (id, name, max_quantity, status, price, restaurant_id)
values ('111a1b11-aaaa-4aaa-baaa-001a1a1a0001', 'Thêm Phô Mai', 5, 'ACTIVE', 15000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('222b2c22-bbbb-4bbb-cbbb-002b2b2b0002', 'Thêm Thịt Bò', 5, 'ACTIVE', 25000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('333c3d33-cccc-4ccc-dccc-003c3c3c0003', 'Thêm Thịt Gà', 5, 'ACTIVE', 20000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('444d4e44-dddd-4ddd-eeee-004d4d4d0004', 'Thêm Hải Sản', 5, 'ACTIVE', 25000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('555e5f55-eeee-4eee-ffff-005e5e5e0005', 'Thêm Xúc Xích', 5, 'ACTIVE', 15000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('666f6066-ffff-4fff-aaaa-006f6f6f0006', 'Sốt BBQ', 5, 'ACTIVE', 10000, '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('777a7177-abab-4a7a-b7b7-007a7a7a0007', 'Sốt Teriyaki', 5, 'ACTIVE', 12000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('888b8288-bcbc-4b8b-c8c8-008b8b8b0008', 'Sốt Phô Mai', 5, 'ACTIVE', 15000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('999c9399-cdcd-4c9c-d9d9-009c9c9c0009', 'Sốt Cay Hàn Quốc', 5, 'ACTIVE', 10000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('aaa3a4aa-dede-4dad-eaea-010a0a0a0010', 'Thêm Trứng Ốp La', 5, 'ACTIVE', 10000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('bbb4b5bb-efef-4ebb-fbfb-011b1b1b0011', 'Thêm Trứng Luộc', 5, 'ACTIVE', 8000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('ccc5c6cc-afaf-4fcc-acac-012c2c2c0012', 'Rau Củ Thêm', 5, 'ACTIVE', 7000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('ddd6d7dd-b0b0-4add-bdbd-013d3d3d0013', 'Khoai Tây Chiên', 5, 'ACTIVE', 15000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('eee7e8ee-c1c1-4bee-cece-014e4e4e0014', 'Bánh Mì Thêm', 5, 'ACTIVE', 5000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('fff8f9ff-d2d2-4cff-dfdf-015f5f5f0015', 'Nấm Xào Thêm', 5, 'ACTIVE', 12000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('abc1a1ab-e3e3-4acc-ecec-016a6a6a0016', 'Hành Phi', 5, 'ACTIVE', 5000, '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('abd2b2ac-f4f4-4bdd-fdfd-017b7b7b0017', 'Tỏi Phi', 5, 'ACTIVE', 5000, '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('abe3c3ad-a5a5-4cee-bebe-018c8c8c0018', 'Ớt Chuông Thêm', 5, 'ACTIVE', 8000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('abf4d4ae-b6b6-4def-cfcf-019d9d9d0019', 'Phô Mai Bào', 5, 'ACTIVE', 15000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('ac05e5af-c7c7-4eef-e0e0-020e0e0e0020', 'Bơ Thêm', 5, 'ACTIVE', 10000, '5edea57e-6226-4072-8ea6-401e47e6e240');

insert into options (id, name, required, status, price, restaurant_id)
values ('opt201-aaaa-bbbb-cccc-000000000201', 'Chế Biến Nướng', 0, 'ACTIVE', 10000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('opt202-aaaa-bbbb-cccc-000000000202', 'Chế Biến Hấp', 0, 'ACTIVE', 10000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('opt203-aaaa-bbbb-cccc-000000000203', 'Chế Biến Xào', 0, 'ACTIVE', 10000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('opt204-aaaa-bbbb-cccc-000000000204', 'Gia Vị Thêm: Tỏi', 0, 'ACTIVE', 5000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('opt205-aaaa-bbbb-cccc-000000000205', 'Gia Vị Thêm: Tiêu', 0, 'ACTIVE', 5000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('opt206-aaaa-bbbb-cccc-000000000206', 'Gia Vị Thêm: Muối Ăn Liền', 0, 'ACTIVE', 5000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('opt207-aaaa-bbbb-cccc-000000000207', 'Dùng Kèm Nước Sốt Riêng', 0, 'ACTIVE', 7000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('opt208-aaaa-bbbb-cccc-000000000208', 'Ăn Kèm Bánh Mì', 0, 'ACTIVE', 5000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('opt209-aaaa-bbbb-cccc-000000000209', 'Ăn Kèm Cơm Trắng', 0, 'ACTIVE', 5000,
        '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('opt210-aaaa-bbbb-cccc-000000000210', 'Trang Trí Thêm Rau Thơm', 0, 'ACTIVE', 7000,
        '5edea57e-6226-4072-8ea6-401e47e6e240');

-- 4 món Khai Vị
INSERT INTO products (id, name, description, tag, image_url, status, price, restaurant_id, menu_id)
VALUES ('prod101', 'Gỏi Cuốn Tôm', 'Gỏi cuốn tươi ngon, cuộn tôm, rau sống.', 'goi, tom',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 45000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'cf7a5b21-94d4-4a22-8d33-101adbe90101'),
       ('prod102', 'Chả Giò Chiên', 'Chả giò giòn rụm, ăn kèm nước mắm.', 'cha, gio',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 40000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'cf7a5b21-94d4-4a22-8d33-101adbe90101'),
       ('prod103', 'Salad Trộn', 'Rau củ tươi trộn sốt đặc biệt.', 'salad',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 35000, '5edea57e-6226-4072-8ea6-401e47e6e240', 'cf7a5b21-94d4-4a22-8d33-101adbe90101'),
       ('prod104', 'Súp Ngô', 'Súp ngô ngọt, béo, thơm ngon.', 'sup, ngo',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 30000, '5edea57e-6226-4072-8ea6-401e47e6e240', 'cf7a5b21-94d4-4a22-8d33-101adbe90101');

-- 8 món Món Chính
INSERT INTO products (id, name, description, tag, image_url, status, price, restaurant_id, menu_id)
VALUES ('prod105', 'Burger Bò Phô Mai', 'Burger thịt bò kèm phô mai tan chảy, ăn kèm khoai tây chiên.',
        'burger, bo, pho mai',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 120000,
        '5edea57e-6226-4072-8ea6-401e47e6e240', 'd0a2b732-a51c-4f5a-8ee0-202bdce90202'),
       ('prod106', 'Pizza Hải Sản', 'Pizza topping hải sản tươi ngon.', 'pizza, hai san',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 150000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'd0a2b732-a51c-4f5a-8ee0-202bdce90202'),
       ('prod107', 'Mì Xào Bò', 'Mì xào thịt bò, rau củ, sốt đặc biệt.', 'mi, xao, bo',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 90000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'd0a2b732-a51c-4f5a-8ee0-202bdce90202'),
       ('prod108', 'Cơm Chiên Hải Sản', 'Cơm chiên hải sản, trứng và rau củ.', 'com, chien, hai san',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 95000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'd0a2b732-a51c-4f5a-8ee0-202bdce90202'),
       ('prod109', 'Gà Nướng Sốt Teriyaki', 'Gà nướng sốt Teriyaki thơm ngon.', 'ga, nuong',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 110000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'd0a2b732-a51c-4f5a-8ee0-202bdce90202'),
       ('prod110', 'Bò Lúc Lắc', 'Bò lúc lắc sốt tiêu đen, ăn kèm salad.', 'bo, luc lac',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 120000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'd0a2b732-a51c-4f5a-8ee0-202bdce90202'),
       ('prod111', 'Cá Hồi Nướng', 'Cá hồi nướng ăn kèm rau củ hấp.', 'ca, hoi, nuong',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 140000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'd0a2b732-a51c-4f5a-8ee0-202bdce90202'),
       ('prod112', 'Mì Ý Sốt Bò Bằm', 'Mì Ý sốt bò bằm đậm vị.', 'mi, y, bo',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 100000, '5edea57e-6226-4072-8ea6-401e47e6e240', 'd0a2b732-a51c-4f5a-8ee0-202bdce90202');

-- 4 món Tráng Miệng
INSERT INTO products (id, name, description, tag, image_url, status, price, restaurant_id, menu_id)
VALUES ('prod113', 'Bánh Flan', 'Bánh flan trứng mềm mịn.', 'banh, flan',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 40000, '5edea57e-6226-4072-8ea6-401e47e6e240', 'e1b3c843-b62d-4c6f-9ff1-303cdfe90303'),
       ('prod114', 'Chè Thái', 'Chè Thái mát lạnh, nhiều topping.', 'che, thai',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 45000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'e1b3c843-b62d-4c6f-9ff1-303cdfe90303'),
       ('prod115', 'Kem Trái Cây', 'Kem trái cây tươi ngon.', 'kem, trai cay',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 50000, '5edea57e-6226-4072-8ea6-401e47e6e240', 'e1b3c843-b62d-4c6f-9ff1-303cdfe90303'),
       ('prod116', 'Bánh Bông Lan Cuộn', 'Bánh bông lan mềm, cuộn nhân kem.', 'banh, bong lan',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 40000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'e1b3c843-b62d-4c6f-9ff1-303cdfe90303');

-- 4 món Đồ Uống
INSERT INTO products (id, name, description, tag, image_url, status, price, restaurant_id, menu_id)
VALUES ('prod117', 'Cà Phê Sữa', 'Cà phê sữa đá truyền thống.', 'ca phe, sua',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 35000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'f2c4d954-c73e-4d70-af01-404defea0404'),
       ('prod118', 'Trà Chanh', 'Trà chanh tươi mát.', 'tra, chanh',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 30000, '5edea57e-6226-4072-8ea6-401e47e6e240', 'f2c4d954-c73e-4d70-af01-404defea0404'),
       ('prod119', 'Nước Ép Cam', 'Nước ép cam tươi.', 'nuoc, ep, cam',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 40000, '5edea57e-6226-4072-8ea6-401e47e6e240', 'f2c4d954-c73e-4d70-af01-404defea0404'),
       ('prod120', 'Cocktail Trái Cây', 'Cocktail nhiều loại trái cây tươi.', 'cocktail, trai cay',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 70000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'f2c4d954-c73e-4d70-af01-404defea0404');

-- Product Toppings
INSERT INTO product_toppings (product_id, topping_id)
VALUES
-- Khai Vị
('prod101', 'ccc5c6cc-afaf-4fcc-acac-012c2c2c0012'), -- Rau Củ Thêm
('prod101', 'eee7e8ee-c1c1-4bee-cece-014e4e4e0014'), -- Bánh Mì Thêm
('prod101', 'ddd6d7dd-b0b0-4add-bdbd-013d3d3d0013'), -- Khoai Tây Chiên

('prod102', 'ccc5c6cc-afaf-4fcc-acac-012c2c2c0012'),
('prod102', 'abc1a1ab-e3e3-4acc-ecec-016a6a6a0016'), -- Hành Phi
('prod102', 'abd2b2ac-f4f4-4bdd-fdfd-017b7b7b0017'), -- Tỏi Phi

('prod103', 'ccc5c6cc-afaf-4fcc-acac-012c2c2c0012'),
('prod103', 'eee7e8ee-c1c1-4bee-cece-014e4e4e0014'),
('prod103', 'fff8f9ff-d2d2-4cff-dfdf-015f5f5f0015'), -- Nấm Xào Thêm

('prod104', 'ddd6d7dd-b0b0-4add-bdbd-013d3d3d0013'),
('prod104', 'eee7e8ee-c1c1-4bee-cece-014e4e4e0014'),
('prod104', 'abe3c3ad-a5a5-4cee-bebe-018c8c8c0018'), -- Ớt Chuông Thêm

-- Món Chính
('prod105', '111a1b11-aaaa-4aaa-baaa-001a1a1a0001'), -- Thêm Phô Mai
('prod105', 'ddd6d7dd-b0b0-4add-bdbd-013d3d3d0013'),
('prod105', 'ccc5c6cc-afaf-4fcc-acac-012c2c2c0012'),

('prod106', '444d4e44-dddd-4ddd-eeee-004d4d4d0004'), -- Thêm Hải Sản
('prod106', 'bbb4b5bb-efef-4ebb-fbfb-011b1b1b0011'), -- Thêm Trứng Luộc
('prod106', 'ddd6d7dd-b0b0-4add-bdbd-013d3d3d0013'),

('prod107', '333c3d33-cccc-4ccc-dccc-003c3c3c0003'), -- Thêm Thịt Gà
('prod107', 'abc1a1ab-e3e3-4acc-ecec-016a6a6a0016'),
('prod107', 'abe3c3ad-a5a5-4cee-bebe-018c8c8c0018'),

('prod108', '444d4e44-dddd-4ddd-eeee-004d4d4d0004'),
('prod108', '111a1b11-aaaa-4aaa-baaa-001a1a1a0001'),
('prod108', 'ddd6d7dd-b0b0-4add-bdbd-013d3d3d0013'),

('prod109', '333c3d33-cccc-4ccc-dccc-003c3c3c0003'),
('prod109', '666f6066-ffff-4fff-aaaa-006f6f6f0006'), -- Sốt BBQ
('prod109', '777a7177-abab-4a7a-b7b7-007a7a7a0007'), -- Sốt Teriyaki

('prod110', '222b2c22-bbbb-4bbb-cbbb-002b2b2b0002'), -- Thêm Thịt Bò
('prod110', '111a1b11-aaaa-4aaa-baaa-001a1a1a0001'),
('prod110', 'ddd6d7dd-b0b0-4add-bdbd-013d3d3d0013'),

('prod111', '444d4e44-dddd-4ddd-eeee-004d4d4d0004'),
('prod111', '555e5f55-eeee-4eee-ffff-005e5e5e0005'), -- Thêm Xúc Xích
('prod111', 'abc1a1ab-e3e3-4acc-ecec-016a6a6a0016'),

('prod112', '111a1b11-aaaa-4aaa-baaa-001a1a1a0001'),
('prod112', '222b2c22-bbbb-4bbb-cbbb-002b2b2b0002'),
('prod112', 'ddd6d7dd-b0b0-4add-bdbd-013d3d3d0013'),

-- Tráng Miệng
('prod113', 'eee7e8ee-c1c1-4bee-cece-014e4e4e0014'),
('prod113', 'fff8f9ff-d2d2-4cff-dfdf-015f5f5f0015'),
('prod113', 'abc1a1ab-e3e3-4acc-ecec-016a6a6a0016'),

('prod114', 'eee7e8ee-c1c1-4bee-cece-014e4e4e0014'),
('prod114', 'abc1a1ab-e3e3-4acc-ecec-016a6a6a0016'),
('prod114', 'abd2b2ac-f4f4-4bdd-fdfd-017b7b7b0017'),

('prod115', 'eee7e8ee-c1c1-4bee-cece-014e4e4e0014'),
('prod115', 'fff8f9ff-d2d2-4cff-dfdf-015f5f5f0015'),
('prod115', 'abe3c3ad-a5a5-4cee-bebe-018c8c8c0018'),

('prod116', 'eee7e8ee-c1c1-4bee-cece-014e4e4e0014'),
('prod116', 'abc1a1ab-e3e3-4acc-ecec-016a6a6a0016'),
('prod116', 'abd2b2ac-f4f4-4bdd-fdfd-017b7b7b0017'),

-- Đồ Uống
('prod117', 'aaa3a4aa-dede-4dad-eaea-010a0a0a0010'), -- Thêm Trứng Ốp La
('prod117', 'bbb4b5bb-efef-4ebb-fbfb-011b1b1b0011'),
('prod117', 'ddd6d7dd-b0b0-4add-bdbd-013d3d3d0013'),

('prod118', 'eee7e8ee-c1c1-4bee-cece-014e4e4e0014'),
('prod118', 'fff8f9ff-d2d2-4cff-dfdf-015f5f5f0015'),
('prod118', 'abc1a1ab-e3e3-4acc-ecec-016a6a6a0016'),

('prod119', 'ddd6d7dd-b0b0-4add-bdbd-013d3d3d0013'),
('prod119', 'eee7e8ee-c1c1-4bee-cece-014e4e4e0014'),
('prod119', 'fff8f9ff-d2d2-4cff-dfdf-015f5f5f0015'),

('prod120', 'aaa3a4aa-dede-4dad-eaea-010a0a0a0010'),
('prod120', 'bbb4b5bb-efef-4ebb-fbfb-011b1b1b0011'),
('prod120', 'ccc5c6cc-afaf-4fcc-acac-012c2c2c0012');

-- Product Options
INSERT INTO product_options (product_id, option_id)
VALUES
-- Khai Vị
('prod101', 'opt201-aaaa-bbbb-cccc-000000000201'),
('prod101', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod101', 'opt208-aaaa-bbbb-cccc-000000000208'),

('prod102', 'opt201-aaaa-bbbb-cccc-000000000201'),
('prod102', 'opt205-aaaa-bbbb-cccc-000000000205'),
('prod102', 'opt207-aaaa-bbbb-cccc-000000000207'),

('prod103', 'opt202-aaaa-bbbb-cccc-000000000202'),
('prod103', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod103', 'opt209-aaaa-bbbb-cccc-000000000209'),

('prod104', 'opt202-aaaa-bbbb-cccc-000000000202'),
('prod104', 'opt205-aaaa-bbbb-cccc-000000000205'),
('prod104', 'opt210-aaaa-bbbb-cccc-000000000210'),

-- Món Chính
('prod105', 'opt201-aaaa-bbbb-cccc-000000000201'),
('prod105', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod105', 'opt208-aaaa-bbbb-cccc-000000000208'),

('prod106', 'opt202-aaaa-bbbb-cccc-000000000202'),
('prod106', 'opt205-aaaa-bbbb-cccc-000000000205'),
('prod106', 'opt209-aaaa-bbbb-cccc-000000000209'),

('prod107', 'opt203-aaaa-bbbb-cccc-000000000203'),
('prod107', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod107', 'opt210-aaaa-bbbb-cccc-000000000210'),

('prod108', 'opt201-aaaa-bbbb-cccc-000000000201'),
('prod108', 'opt207-aaaa-bbbb-cccc-000000000207'),
('prod108', 'opt208-aaaa-bbbb-cccc-000000000208'),

('prod109', 'opt202-aaaa-bbbb-cccc-000000000202'),
('prod109', 'opt205-aaaa-bbbb-cccc-000000000205'),
('prod109', 'opt206-aaaa-bbbb-cccc-000000000206'),

('prod110', 'opt203-aaaa-bbbb-cccc-000000000203'),
('prod110', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod110', 'opt208-aaaa-bbbb-cccc-000000000208'),

('prod111', 'opt201-aaaa-bbbb-cccc-000000000201'),
('prod111', 'opt207-aaaa-bbbb-cccc-000000000207'),
('prod111', 'opt210-aaaa-bbbb-cccc-000000000210'),

('prod112', 'opt202-aaaa-bbbb-cccc-000000000202'),
('prod112', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod112', 'opt209-aaaa-bbbb-cccc-000000000209'),

-- Tráng Miệng
('prod113', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod113', 'opt205-aaaa-bbbb-cccc-000000000205'),
('prod113', 'opt208-aaaa-bbbb-cccc-000000000208'),

('prod114', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod114', 'opt205-aaaa-bbbb-cccc-000000000205'),
('prod114', 'opt209-aaaa-bbbb-cccc-000000000209'),

('prod115', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod115', 'opt206-aaaa-bbbb-cccc-000000000206'),
('prod115', 'opt208-aaaa-bbbb-cccc-000000000208'),

('prod116', 'opt205-aaaa-bbbb-cccc-000000000205'),
('prod116', 'opt206-aaaa-bbbb-cccc-000000000206'),
('prod116', 'opt210-aaaa-bbbb-cccc-000000000210'),

-- Đồ Uống
('prod117', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod117', 'opt205-aaaa-bbbb-cccc-000000000205'),
('prod117', 'opt208-aaaa-bbbb-cccc-000000000208'),

('prod118', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod118', 'opt206-aaaa-bbbb-cccc-000000000206'),
('prod118', 'opt209-aaaa-bbbb-cccc-000000000209'),

('prod119', 'opt205-aaaa-bbbb-cccc-000000000205'),
('prod119', 'opt206-aaaa-bbbb-cccc-000000000206'),
('prod119', 'opt210-aaaa-bbbb-cccc-000000000210'),

('prod120', 'opt204-aaaa-bbbb-cccc-000000000204'),
('prod120', 'opt205-aaaa-bbbb-cccc-000000000205'),
('prod120', 'opt208-aaaa-bbbb-cccc-000000000208');

-- Combo 1
INSERT INTO products (id, name, description, tag, image_url, status, price, restaurant_id, menu_id)
VALUES ('combo001', 'Combo 1: Khai Vị + Món Chính + Tráng Miệng',
        'Gồm 1 món khai vị, 1 món chính và 1 món tráng miệng',
        'combo',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 150000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'a3d5ea65-d84f-4e81-b102-505effeb0505');

-- Combo 2
INSERT INTO products (id, name, description, tag, image_url, status, price, restaurant_id, menu_id)
VALUES ('combo002', 'Combo 2: Khai Vị + Món Chính + Tráng Miệng',
        'Gồm 1 món khai vị, 1 món chính và 1 món tráng miệng',
        'combo',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 170000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'a3d5ea65-d84f-4e81-b102-505effeb0505');

-- Combo 3
INSERT INTO products (id, name, description, tag, image_url, status, price, restaurant_id, menu_id)
VALUES ('combo003', 'Combo 3: Khai Vị + Món Chính + Tráng Miệng',
        'Gồm 1 món khai vị, 1 món chính và 1 món tráng miệng',
        'combo',
        'https://c8.alamy.com/comp/2G1060E/chef-avatar-cook-man-working-restaurant-services-profile-user-person-people-icon-isolated-vector-illustration-2G1060E.jpg',
        'ACTIVE', 200000, '5edea57e-6226-4072-8ea6-401e47e6e240',
        'a3d5ea65-d84f-4e81-b102-505effeb0505');

-- Combo 1 toppings (ví dụ)
INSERT INTO product_toppings (product_id, topping_id)
VALUES ('combo001', 'ccc5c6cc-afaf-4fcc-acac-012c2c2c0012'), -- Rau Củ Thêm
       ('combo001', '111a1b11-aaaa-4aaa-baaa-001a1a1a0001'), -- Thêm Phô Mai
       ('combo001', 'eee7e8ee-c1c1-4bee-cece-014e4e4e0014');
-- Bánh Mì Thêm

-- Combo 1 options (ví dụ)
INSERT INTO product_options (product_id, option_id)
VALUES ('combo001', 'opt201-aaaa-bbbb-cccc-000000000201'), -- Chế Biến Nướng
       ('combo001', 'opt204-aaaa-bbbb-cccc-000000000204'), -- Gia Vị Thêm: Tỏi
       ('combo001', 'opt208-aaaa-bbbb-cccc-000000000208');
-- Ăn Kèm Bánh Mì

-- Combo 2 toppings
INSERT INTO product_toppings (product_id, topping_id)
VALUES ('combo002', 'ddd6d7dd-b0b0-4add-bdbd-013d3d3d0013'),
       ('combo002', '222b2c22-bbbb-4bbb-cbbb-002b2b2b0002'),
       ('combo002', 'fff8f9ff-d2d2-4cff-dfdf-015f5f5f0015');

-- Combo 2 options
INSERT INTO product_options (product_id, option_id)
VALUES ('combo002', 'opt205-aaaa-bbbb-cccc-000000000205'),
       ('combo002', 'opt206-aaaa-bbbb-cccc-000000000206'),
       ('combo002', 'opt209-aaaa-bbbb-cccc-000000000209');

-- Combo 3 toppings
INSERT INTO product_toppings (product_id, topping_id)
VALUES ('combo003', '444d4e44-dddd-4ddd-eeee-004d4d4d0004'),
       ('combo003', '555e5f55-eeee-4eee-ffff-005e5e5e0005'),
       ('combo003', 'bbb4b5bb-efef-4ebb-fbfb-011b1b1b0011');

-- Combo 3 options
INSERT INTO product_options (product_id, option_id)
VALUES ('combo003', 'opt201-aaaa-bbbb-cccc-000000000201'),
       ('combo003', 'opt207-aaaa-bbbb-cccc-000000000207'),
       ('combo003', 'opt210-aaaa-bbbb-cccc-000000000210');


INSERT INTO promotions (id, name, status, value, type, start_date, end_date, start_hour, end_hour, restaurant_id,
                        apply_type)
VALUES ('promo001', 'Giảm 10% Khai Vị', 'ACTIVE', 10, 'PERCENT', '2025-11-01', '2025-12-31', '00:00', '23:59',
        '5edea57e-6226-4072-8ea6-401e47e6e240', 'ORDER_ITEM'),
       ('promo002', 'Giảm 20k cho Món Chính', 'ACTIVE', 20000, 'VALUE', '2025-11-01', '2025-12-31', '0:00', '23:59',
        '5edea57e-6226-4072-8ea6-401e47e6e240', 'ORDER_ITEM'),
       ('promo003', 'Giảm 15% Đồ Uống', 'ACTIVE', 15, 'PERCENT', '2025-11-01', '2025-12-31', '0:00', '23:59',
        '5edea57e-6226-4072-8ea6-401e47e6e240', 'ORDER_ITEM'),
       ('promo004', 'Giảm 50k cho hóa đơn', 'ACTIVE', 50000, 'VALUE', '2025-11-01', '2025-12-31', '00:00',
        '23:59', '5edea57e-6226-4072-8ea6-401e47e6e240', 'ORDER'),
       ('promo005', 'Giảm 5% Combo Đặc Biệt', 'ACTIVE', 5, 'PERCENT', '2025-11-01', '2025-12-31', '00:00', '23:59',
        '5edea57e-6226-4072-8ea6-401e47e6e240', 'ORDER_ITEM');


-- Promo 1: Giảm 10% Khai Vị → menu Khai Vị
INSERT INTO promotion_menus (promotion_id, menu_id)
VALUES ('promo001', 'cf7a5b21-94d4-4a22-8d33-101adbe90101');

-- Promo 2: Giảm 20k cho Món Chính → menu Món Chính
INSERT INTO promotion_menus (promotion_id, menu_id)
VALUES ('promo002', 'd0a2b732-a51c-4f5a-8ee0-202bdce90202');

-- Promo 3: Giảm 15% Đồ Uống → menu Đồ Uống
INSERT INTO promotion_menus (promotion_id, menu_id)
VALUES ('promo003', 'f2c4d954-c73e-4d70-af01-404defea0404');

-- Promo 4: Giảm 50k cho hóa đơn → áp dụng toàn bộ menu (nếu cần, có thể gán tất cả menu)
INSERT INTO promotion_menus (promotion_id, menu_id)
VALUES ('promo004', 'cf7a5b21-94d4-4a22-8d33-101adbe90101'),
       ('promo004', 'd0a2b732-a51c-4f5a-8ee0-202bdce90202'),
       ('promo004', 'e1b3c843-b62d-4c6f-9ff1-303cdfe90303'),
       ('promo004', 'f2c4d954-c73e-4d70-af01-404defea0404'),
       ('promo004', 'a3d5ea65-d84f-4e81-b102-505effeb0505');

-- Promo 5: Giảm 5% Combo Đặc Biệt → menu Combo Đặc Biệt
INSERT INTO promotion_menus (promotion_id, menu_id)
VALUES ('promo005', 'a3d5ea65-d84f-4e81-b102-505effeb0505');


INSERT INTO payment_methods (id, name, code, status, restaurant_id)
VALUES ('pm001', 'Tiền Mặt', 'CASH', 'ACTIVE', '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('pm002', 'Thẻ Ngân Hàng', 'CARD', 'ACTIVE', '5edea57e-6226-4072-8ea6-401e47e6e240'),
       ('pm003', 'Ví Điện Tử', 'E_WALLET', 'ACTIVE', '5edea57e-6226-4072-8ea6-401e47e6e240');
