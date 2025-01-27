library IEEE;
use IEEE.std_logic_1164.ALL;

-- Définition : le spot de l'écran c'est là où le pinceau de l'écran est positionné. Le spot change de place à une 
-- fréquence de 25.2Mhz et parcourt chaque pixels de chaque lignes et colonnes de l'écran de gauche à droite et de heut en bas. 

entity vga_sync is
    port (
        clk_i : in std_logic;  			-- Entrée de la clock à 100Mhz
        reset_i : in std_logic;			-- Entrée du btn_up_i qui reset l'écran : donc qui envoie de manière asynchrone v_sync = 1 à l'écran pour le reset
        h_o : out std_logic;			-- Le retour à la ligne du spot : h_sync
        v_o : out std_logic;			-- La fin d'une image (fin des colonnes) : v_sync
        x_o : out integer range 0 to 799;	-- La coordonnée x du spot de l'écran
        y_o : out integer range 0 to 524	-- La coordonnée y du spot de l 'écran
    );
end vga_sync;

architecture Behavioral of vga_sync is
signal clk_4_i : std_logic;			
signal reset_x : std_logic;
signal reset_y : std_logic;

begin
    div_mod_4 : entity work.compteur_mod_n(Behavioral) -- Divise la clock à 100Mhz en une clock à 25Mhz
        generic map (
            n => 4
        )
        port map (
            clk_i => clk_i, 		-- La clock à 100Mhz
            reset_i => reset_i,		-- La remise à 0 du compteur en cas de reset
            count_o => open,		-- Cf ports du compteur mod n
            reset_o => clk_4_i		-- Sortie : la clock à 25Mhz
        );
        
    compt_mod_800 : entity work.compteur_mod_n(Behavioral) -- Compte le nombre d'impulsion de la clock à 25Mhz pour fournir le x du spot
        generic map (
            n => 800
        )
        port map (
            clk_i => clk_4_i,		-- La clock à 25Mhz
            reset_i => reset_i,		-- La remise à 0 du compteur en cas de reset
            count_o => x_o,		-- Sortie : la valeur actuelle du compteur donc le x du spot de l'écran
            reset_o => reset_x		-- Le signal de sortie quand arrivé à la fin de la ligne
        );
    compt_mod_525 : entity work.compteur_mod_n(Behavioral) -- Compte le nombre d'impulsion reset_x donc le nombre de retour à la ligne pour fournir le y du spot
        generic map (
            n => 525
        )
        port map (
            clk_i => reset_x,		-- L'impulsion de retour à la ligne
            reset_i => reset_i,		-- La remise à 0 du compteur en cas de reset
            count_o => y_o,		-- Sortie : la valeur actuelle du compteur donc le x du spot de l'écran
            reset_o => reset_y		-- Le signal de sortie quand arrivé à la fin de l'image (donc fin des colonnes)
        );
        
    h_o <= reset_x;					-- Envoie une impulsion pour signaler la fin d'une ligne à l'écran vga
    v_o <= reset_y when reset_i = '0' else '1';		-- Envoie une impulsion à l'écran pour signaler la fin d'une image ou quand il y a un reset
    
end Behavioral;