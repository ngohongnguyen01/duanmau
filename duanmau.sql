-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 23, 2020 lúc 01:21 PM
-- Phiên bản máy phục vụ: 10.4.13-MariaDB
-- Phiên bản PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `duanmau`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binhluan`
--

CREATE TABLE `binhluan` (
  `id` int(11) NOT NULL,
  `noi_dung` varchar(255) NOT NULL,
  `ma_hh` int(11) NOT NULL,
  `ma_kh` varchar(20) NOT NULL,
  `ngay_bl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `binhluan`
--

INSERT INTO `binhluan` (`id`, `noi_dung`, `ma_hh`, `ma_kh`, `ngay_bl`) VALUES
(245, 'hi chào cậu', 32, 'kh11', '2020-10-01'),
(266, 'đẹp lắm', 32, 'kh11', '2020-10-05'),
(267, 'xinh gái thế', 32, 'kh11', '2020-10-05'),
(268, 'xuất sắc  luôn', 32, 'kh11', '2020-10-05'),
(269, 'tuyệt vời thật', 32, 'kh11', '2020-10-05'),
(270, 'Qúa là đẹp luôn', 32, 'Kh007', '2020-10-05'),
(273, 'Hello', 48, 'Admin', '2020-10-08'),
(274, 'Áo quá đẹp\r\n', 48, 'Admin', '2020-10-08'),
(275, 'fg', 48, 'Admin', '2020-10-08'),
(276, 'áo đẹp', 54, 'KH1333', '2020-10-15'),
(277, 'đẹp', 19, 'KH1333', '2020-10-15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hanghoa`
--

CREATE TABLE `hanghoa` (
  `id` int(11) NOT NULL,
  `ten_hh` varchar(255) NOT NULL,
  `don_gia` float NOT NULL,
  `giam_gia` float NOT NULL,
  `hinh_anh` varchar(255) NOT NULL,
  `ngay_nhap` date NOT NULL,
  `ma_loai` int(11) NOT NULL,
  `dac_biet` bit(1) NOT NULL,
  `so_luot_xem` int(11) NOT NULL,
  `mo_ta` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `hanghoa`
--

INSERT INTO `hanghoa` (`id`, `ten_hh`, `don_gia`, `giam_gia`, `hinh_anh`, `ngay_nhap`, `ma_loai`, `dac_biet`, `so_luot_xem`, `mo_ta`) VALUES
(13, 'Áo Vimart', 350000, 10, 'content/image/sanpham/5f6a1476c15ca-110308772_604592283787157_4264931965313851910_n.jpg', '2020-09-17', 43, b'0', 7, 'Áo thời trang'),
(15, 'Áo black', 99000, 10, 'content/image/sanpham/5f6c922c1eb7b-109114610_275698897053079_7890756806167436850_n.jpg', '2020-09-02', 43, b'0', 1, 'Phong Cách'),
(16, 'Áo Kẻ Xọc', 159000, 15, 'content/image/sanpham/5f6c92571b22c-113091040_275366727077916_3490488720127102661_n.jpg', '2020-09-08', 43, b'0', 11, 'Siêu bền'),
(18, 'Áo phông Binz', 399000, 10, 'content/image/sanpham/5f7330297529e-ao_so_mi_tay_ngan_mot_tre_lich_lam_abn008_5c50.jpg', '2020-09-16', 43, b'1', 44, 'Ca sĩ Binz đã mặc\r\n'),
(19, 'Áo len cổ lọ', 462000, 10, 'content/image/users/5f82ca3999832_aolen36.jpg', '2020-09-17', 6, b'1', 8, 'Áo ấm hơn vòng tay người yêu'),
(20, 'Áo len xẻ cổ', 399000, 10, 'content/image/sanpham/5f733210678d5-aolen1.jpg', '2020-09-23', 6, b'1', 19, 'Áo chất liệu bền'),
(21, 'Áo len suboi', 1000000, 12, 'content/image/sanpham/5f733305a7b8a-aolen3.jpg', '2020-08-31', 6, b'1', 17, 'Áo len chất lượng cao\r\n'),
(22, 'Áo len style', 688800, 5, 'content/image/sanpham/5f7333631c3a5-aolen4.jpg', '2020-09-01', 6, b'1', 21, 'Áo nhìn là biết dân chơi'),
(23, 'Áo len tôn dáng', 999000, 10, 'content/image/sanpham/5f7333a3468b1-aolen6.jpg', '2020-09-26', 6, b'1', 2, 'Áo mặc không lộ da thịt'),
(24, 'Áo len mùa hè', 1200000, 10, 'content/image/sanpham/5f7333f6b7717-aolen7.jpg', '2020-09-02', 6, b'1', 8, 'Mặc vào là thấy mát'),
(25, 'Áo len mùa cô đơn', 19000000, 10, 'content/image/sanpham/5f73346302d8b-aolen15.jpg', '2020-09-10', 6, b'1', 40, 'Mặc vào có luôn người yêu'),
(26, 'Áo len so cute', 699000, 0, 'content/image/sanpham/5f7335d10525c-aolen17.jpg', '2020-09-19', 6, b'1', 10, 'mặc vào dễ thương '),
(27, 'Áo len beatyfull', 99900000, 10, 'content/image/sanpham/5f73360d13e30-aolen11.jpg', '2020-09-29', 6, b'1', 3, 'Áo mặc vào auto có người yêu'),
(28, 'Áo len trung thu', 1000000, 5, 'content/image/sanpham/5f73364564257-aolen12.jpg', '2020-09-29', 6, b'1', 9, 'Áo trung thu đi đến đâu trai bu đến đó\r\n'),
(29, 'Áo len double', 399000, 5, 'content/image/sanpham/5f7336c257054-aolen18.jpg', '2020-09-10', 6, b'0', 14, 'Mặc ấm như mùa đông'),
(30, 'Áo len siêu mát', 10000000, 10, 'content/image/sanpham/5f73385db50eb-aolen24.jpg', '2020-09-29', 6, b'1', 13, 'Mát như mùa đông'),
(32, 'Áo len chễ', 319000, 10, 'content/image/sanpham/5f734e783140e-aolen25.jpg', '2020-09-28', 6, b'1', 416, 'Áo siêu quyến rũ'),
(34, 'Áo biển', 99000, 10, 'content/image/sanpham/5f7ddfff978a1-115756273_2805587982994091_7677938621377878591_n.jpg', '2020-10-07', 42, b'0', 0, 'Áo hợp cho du lịch cho gia đình'),
(35, 'Áo Panda', 119000, 10, 'content/image/sanpham/5f7de041c4117-109703143_298482207935281_7770724932189510060_n.jpg', '2020-10-07', 42, b'0', 0, 'Rất hợp cho du lịch cùng gia đình'),
(36, 'Áo Pijama', 79000, 0, 'content/image/sanpham/5f7de07223296-109864757_284039996349198_8841460889773461225_n.jpg', '2020-10-07', 42, b'0', 0, 'Áo du lịch biển'),
(37, 'Áo hậu duệ mặt trời', 129000, 5, 'content/image/sanpham/5f7de0b3c88c7-110041476_925471194624877_394028543263975944_n.jpg', '2020-10-07', 42, b'0', 0, 'Áo làm từ chất liệu tự nhiên'),
(38, 'Áo Mickey', 88000, 10, 'content/image/sanpham/5f7de0f9ea9ef-110317233_611282749389635_5882595370341294829_n.jpg', '2020-10-07', 42, b'0', 0, 'Áo rất là đẹp cho những gia đình'),
(39, 'Áo quả bơ Avocado', 680000, 10, 'content/image/sanpham/5f7de17f031eb-áo gd1.jpg', '2020-10-07', 42, b'0', 0, 'Áo là một sự lựa chọn không hề tệ để diện đồ cho cả nhà mình mỗi khi lên ảnh các mẹ nhé'),
(40, 'Áo gia đình Toy Bear', 100000, 0, 'content/image/sanpham/5f7de1c086bd8-aogd2.jpg', '2020-10-07', 42, b'0', 0, 'Với set áo gia đình Toy Bear  của Familylove sẽ là một sự lựa chọn không hề tệ để diện đồ cho cả nhà mình mỗi khi lên ảnh các mẹ nhé.'),
(41, 'Áo gia đình Dream Forever', 199000, 0, 'content/image/sanpham/5f7de22b04cb7-aogd3.jpg', '2020-10-07', 42, b'0', 0, 'Với set áo gia đình Dream Forever  của Familylove sẽ là một sự lựa chọn không hề tệ để diện đồ cho cả nhà mình mỗi khi lên ảnh các mẹ nhé.'),
(42, 'Áo gia đình Nét vẽ Cầu Vòng', 125000, 10, 'content/image/sanpham/5f7de29fa4b39-aogd4.png', '2020-10-07', 42, b'0', 0, 'Với set áo gia đình Nét vẽ Cầu Vòng của Familylove sẽ là một sự lựa chọn không hề tệ để diện đồ cho cả nhà mình mỗi khi lên ảnh các mẹ nhé.'),
(43, 'Áo gia đình Tourism Day', 100000, 0, 'content/image/sanpham/5f7de33ac2fe1-aogd6.jpg', '2020-10-07', 42, b'0', 0, 'Để cho những khoảnh khắc gia đình bên nhau, pose ảnh cùng nhật trở nên thật lung lung bên nhau các mẹ nhé. '),
(44, 'Áo gia đình Happy Toon', 90000, 0, 'content/image/sanpham/5f7de4b223754-anhgd6.jpg', '2020-10-07', 42, b'0', 1, 'Để cho những khoảnh khắc gia đình bên nhau, pose ảnh cùng nhật trở nên thật lung lung, thật đẹp để tô điểm cho ký ức những quãng thời gian bên nhau các mẹ nhé. '),
(45, 'Áo gia đình Rise Up', 299000, 10, 'content/image/sanpham/5f7de6e2c856e-aogd7.png', '2020-10-07', 42, b'0', 0, 'Để cho những khoảnh khắc gia đình bên nhau, pose ảnh cùng nhật trở nên thật lung lung, thật đẹp để tô điểm cho ký ức những quãng thời gian bên nhau các mẹ nhé. '),
(46, 'Auto đẹp trai', 320000, 0, 'content/image/sanpham/5f7de816b0c4c-109821686_288668345717454_8798515576443664183_n.jpg', '2020-10-07', 43, b'0', 1, 'Siêu bình thường'),
(47, 'Áo phông Garena', 1999000, 5, 'content/image/sanpham/5f7de8f172ddd-110055986_2633743253555338_2540854656553303874_n.jpg', '2020-10-07', 43, b'0', 0, 'Áo đắt tý nhưng chất lượng nha'),
(48, 'Áo phông Red', 99000, 10, 'content/image/sanpham/5f7de934800b3-112317762_2745039795718018_2500766988848608388_n.jpg', '2020-10-07', 43, b'0', 7, 'Áo rẻ chất lượng rẻ theo'),
(49, 'Áo phông sọc kẻ', 189000, 10, 'content/image/sanpham/5f7e7e71caa3c-113091040_275366727077916_3490488720127102661_n.jpg', '2020-10-07', 43, b'0', 37, 'Áo trông rất là trẻ trung'),
(50, 'Áo thể thao', 399000, 10, 'content/image/sanpham/5f7e8539924d6-111034730_294167801940304_398455061086870806_n.jpg', '2020-10-08', 6, b'0', 13, 'Áo dành cho thể thao'),
(51, 'Áo đen body', 289000, 10, 'content/image/sanpham/5f7e856abf12a-109581191_334373344397538_7652114296048899248_n.jpg', '2020-10-08', 43, b'0', 6, 'Áo tôn dáng rất đẹp'),
(52, 'Áo brow', 219000, 5, 'content/image/sanpham/5f7e85a56e094-110562108_1520767551435128_8783777818301062817_n.jpg', '2020-10-08', 43, b'0', 1, 'Áo trông hợp với đi chơi'),
(53, 'Áo Thun Ngắn Tay ', 359000, 46, 'content/image/sanpham/5f7e8636b4ec5-apgai.jpg', '2020-10-08', 43, b'0', 4, 'Áo mặc vào auto cute'),
(54, 'Áo Thun Ngắn Tay Nữ', 399000, 15, 'content/image/sanpham/5f7e866f358d7-ao-phong-nu-xan-tay010420191438225512.jpg', '2020-10-08', 43, b'0', 8, 'Áo cho văn phòng'),
(55, 'Áo hoodie', 312000, 5, 'content/image/users/5f8171c0d8eeb_anh3.jpg', '2020-10-09', 6, b'0', 40, 'Đẹp đấy\r\n'),
(56, 'áo $%&&', 123400, 1, 'content/image/users/5f91c037963a4_8ACT03-175K-THUN-ĐEN-TRƠN-4-SIZE-M-L-XL-XXL2.jpg', '2020-02-02', 43, b'0', 7, 'Áo rất đen');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `id` varchar(20) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `ho_ten` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `kich_hoat` bit(1) NOT NULL,
  `hinh` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `vai_tro` bit(1) NOT NULL,
  `ngay_sinh` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`id`, `mat_khau`, `ho_ten`, `kich_hoat`, `hinh`, `email`, `vai_tro`, `ngay_sinh`) VALUES
('Admin', '$2y$10$iDd/TpdlUeBgd9fETcIXy.wi7G9Fe7mPQqy31sEABp46R0FLKcg4K', 'Admin', b'1', 'content/image/users/5f8284fd58c15_109114610_275698897053079_7890756806167436850_n.jpg', '1234@gmail.com', b'1', '0000-00-00'),
('ChuMinhHiep', '$2y$10$CwpIl4NV42LQqcgZkL5mnOsoMelPjL/zJkDBRpvOnfFDnh2x09.0a', 'hiepoccho', b'1', 'content/image/users/5f870af6a2441_ACcFoucv.jpg', 'hiep@gmail.com', b'0', '0000-00-00'),
('Duong', '$2y$10$9oipuqb0hu5TzkDrWKHxP.zdeb316aO2htRVE4w9Wv7oQ58VP7cgW', 'Lê mạnh dương', b'1', 'content/image/users/5f89ae278f194_duong.jpg', 'duong@gmail.com', b'1', '0000-00-00'),
('KH001', '$2y$10$3UNZ0rr1XIebCtGspkh7Fuu537S0b2CXplIljRuQUsQ4WaKwhs0te', 'Nguyên Còi', b'1', 'content/image/users/5f81602998316_anh3.jpg', 'Kh001@gmail.com', b'0', '0000-00-00'),
('Kh007', '$2y$10$jKdsOtddcopMKRTmLxOHcuel9hWgo2UVoalm3xVjSswZsZel78OSa', 'Điệp viên', b'1', 'content/image/users/5f7762aaed8b7_109838006_2666150633598977_8548296580105835819_n.jpg', '00@gmail.com', b'1', '0000-00-00'),
('kh03', '$2y$10$apBjeLo7ba0QnlbTPU6FY.yNTcss8kqA0rkrirGOh7DYyCEWdPpT.', 'Quân', b'1', 'content/image/users/5f730395bc728_165_Ao_thun_nam_co_tru_mau_tim_phoi_nut_b3369.jpg', 'quan@gmail.com', b'0', '0000-00-00'),
('kh1003', '$2y$10$L6xHPezQAcUf1K4esymiWOtfQQyNeuS6vMIvsxjkovEEbs8OTO/wS', 'haha', b'1', 'content/image/users/5f84f6c67f956_109838006_2666150633598977_8548296580105835819_n.jpg', 'tuan@gmail.com', b'0', '0000-00-00'),
('kh11', '$2y$10$Z8UVJ.lA6icF2zrba7/Fo.OEDvvnk9atsUluwM9F0Zm/e79kRP1PW', 'Xinh gái', b'1', 'content/image/users/5f73ef95cd6e0_aolen1.jpg', 'khongco@gmail.com', b'0', '0000-00-00'),
('KH12', '$2y$10$YWfQMcUxg84kq1V.ILSUTO.MfvjZPvX5BQjjR/cC4kKF.jsKsYOwW', 'KH12', b'1', 'content/image/users/5f7b4cbf103cd_111034730_294167801940304_398455061086870806_n.jpg', 'kh12@gmail.com', b'1', '0000-00-00'),
('KH1234', '$2y$10$gdGwKHKiwCVUvWbypQXd4e9HwbV0x1pfkm6A7WO3qSVlmpMXAiW4e', 'KHmot', b'1', 'content/image/users/5f8438c16f1bb_109581191_334373344397538_7652114296048899248_n.jpg', 'KH1234@gmail.com', b'0', '0000-00-00'),
('kh1329432', '$2y$10$bJ7w5ebd2gJAkrK4d3wi9OwrealbOMXpdhkbfy2EvtairnPg.tt36', 'Khachs hang', b'1', 'content/image/users/5f8ff8bf3542c_Haha.jpg', '07@gmail.com', b'0', '0000-00-00'),
('KH1333', '$2y$10$wA0k.hhggEpiIpCKWWuJZOuaCGmXe.wcpa6Kw3c7NXZ.SKEq5EclC', 'Anh nguyên', b'1', 'content/image/users/5f91ac1d188bb_dayhang.png', 'KH113@gmail.com', b'0', '0000-00-00'),
('kh_thuong', '$2y$10$5Kl1TiodBZOGAAVW8fTJIOnsfmNflVW8TYGtFhQYFiMOJzeHWtYkq', 'Phùng văn thương', b'1', 'content/image/users/5f91a2f44815b_109506070_278826423373544_3079800519701265271_n.jpg', 'thuong@gmail.com', b'0', '0000-00-00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaihang`
--

CREATE TABLE `loaihang` (
  `id` int(11) NOT NULL,
  `ten_loai` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loaihang`
--

INSERT INTO `loaihang` (`id`, `ten_loai`) VALUES
(6, 'Áo Len'),
(42, 'Áo Gia Đình'),
(43, 'Áo Phông'),
(45, 'Quần dài');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bl_hh` (`ma_hh`),
  ADD KEY `fk_bl_kh` (`ma_kh`);

--
-- Chỉ mục cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_hh_lh` (`ma_loai`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `loaihang`
--
ALTER TABLE `loaihang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT cho bảng `loaihang`
--
ALTER TABLE `loaihang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binhluan`
--
ALTER TABLE `binhluan`
  ADD CONSTRAINT `fk_bl_hh` FOREIGN KEY (`ma_hh`) REFERENCES `hanghoa` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_bl_kh` FOREIGN KEY (`ma_kh`) REFERENCES `khachhang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `hanghoa`
--
ALTER TABLE `hanghoa`
  ADD CONSTRAINT `fk_hh_lh` FOREIGN KEY (`ma_loai`) REFERENCES `loaihang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
