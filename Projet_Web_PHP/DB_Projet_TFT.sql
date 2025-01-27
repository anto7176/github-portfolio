
CREATE DATABASE PROJET;
USE PROJET;


CREATE TABLE unit (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    cost INT NOT NULL,
    origin VARCHAR(50) NOT NULL,
    url_img VARCHAR(250) NOT NULL
);

INSERT INTO unit (name, cost, origin, url_img) VALUES
('Riven', 4, 'Exilé', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Riven_23.jpg'),
('Yasuo', 4, 'Exilé', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Yasuo_57.jpg'),
('Aatrox', 4, 'Démon', 'https://images3.alphacoders.com/130/1304890.jpg'),
('Sivir', 3, 'Exilé', 'https://fbi.cults3d.com/uploaders/25822624/illustration-file/ae952d19-579a-423f-9b84-5f00163b611d/splashart.jpg'),
('Shyvana', 5, 'Dragon', 'https://rare-gallery.com/uploads/posts/361246-4k-wallpaper.jpg'),
('Lux', 3, 'Lumière', 'https://artistmonkeys.com/wp-content/uploads/2023/11/League-of-Legends-Lux-LOL-1-scaled.jpg'),
('Senna', 3, 'Sentinelle', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Senna_56.jpg'),
('Jinx', 1, 'Zaun', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Jinx_1.jpg'),
('Teemo', 3, 'Bandle City', 'https://cmsassets.rgpub.io/sanity/images/dsfx7636/game_data/f6ea0954dd9387c57790f2f60766ac3033bac35e-1280x720.jpg'),
('Aurelion Sol', 5, 'Dragon Céleste', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/AurelionSol_0.jpg'),
('Zed', 4, 'Ordre Kinkou', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Zed_58.jpg'),
('Ashe', 2, 'Freljord', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Ashe_0.jpg'),
('Shaco', 3, 'Inconnue', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Shaco_2.jpg'),
('Morgana', 3, 'Céleste', 'https://picfiles.alphacoders.com/603/603044.jpg'),
('Tristana', 1, 'Yordles', 'https://cmsassets.rgpub.io/sanity/images/dsfx7636/game_data/a5645b817749d8c48758ad1922b839ed284c813d-1280x720.jpg'),
('ChoGath', 5, 'Néant', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Chogath_0.jpg'),
('Renekton', 3, 'Shurima', 'https://wiki.leagueoflegends.com/en-us/images/Renekton_OriginalSkin.jpg?5a7fd'),
('Veigar', 3, 'Yordles', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Veigar_1.jpg'),
('Nasus', 4, 'Shurima', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Nasus_25.jpg'),
('Miss Fortune', 2, 'Bilgewater', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/MissFortune_8.jpg'),
('Twisted Fate', 2, 'Bilgewater', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/TwistedFate_5.jpg'),
('Bard', 1, 'Céleste', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Bard_17.jpg'),
('Leblanc', 4, 'Runterra', 'https://preview.redd.it/leblanc-clone-and-her-agent-v0-5y2mxhl9ntqb1.jpg?width=1080&crop=smart&auto=webp&s=50294f52168a92b3158ffbebce0aa828f2e3a6e4'),
('Pyke', 3, 'Bilgewater', 'https://cmsassets.rgpub.io/sanity/images/dsfx7636/game_data/826ce569e778bf7227cf636db24d35974fd45a24-1280x720.jpg'),
('Viego', 3, 'Îles obscures', 'https://www.team-aaa.com/upload/admin/LoL/PBE/14.19/Viego%20des%20Worlds%202024.jfif'),
('Vladimir', 1, 'Noxus', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Vladimir_1.jpg'),
('Udyr', 4, 'Freljord', 'https://ddragon.leagueoflegends.com/cdn/img/champion/splash/Udyr_3.jpg');

