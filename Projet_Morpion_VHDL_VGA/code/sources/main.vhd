library IEEE;
use IEEE.STD_LOGIC_1164.ALL;

entity main is
    port (
	-- Entrées de la carte
        clk_main_i : in std_logic;
        btn_up_i : in std_logic;
        btn_center_i : in std_logic;
        switches_i : in std_logic_vector(8 downto 0);

	-- Sorties vers l'écran
        hsync_o : out std_logic;
        vsync_o : out std_logic;
        vga_red_o : out std_logic_vector(3 downto 0);
        vga_green_o : out std_logic_vector(3 downto 0);
        vga_blue_o : out std_logic_vector(3 downto 0)
    );
end main;

architecture Behavioral of main is
signal x_reg : integer range 0 to 799;		-- Position x du spot (cf commentaire vga_sync pour la définition du spot)
signal y_reg : integer range 0 to 524;		-- Position y du spot
signal cases : std_logic_vector(17 downto 0); 	-- Cf rapport ou commentaires du graph_manager

begin

    -- Cf rapport pour les entités, leurs but et fonctionnement + commentaires dans leurs fichiers

    vga_sync : entity work.vga_sync(Behavioral) 
        port map (
            clk_i => clk_main_i,
            reset_i => btn_up_i,
            h_o => hsync_o,
            v_o => vsync_o,
            x_o => x_reg,
            y_o => y_reg
        );
        
    game_manager : entity work.game_manager(Behavioral)
        port map (
            choice_i => switches_i,
            cases_o => cases,
            btn_valid_i => btn_center_i,
            reset_i => btn_up_i,
            clk_i => clk_main_i
       );
            
    graph_manager : entity work.graph_manager(behavior)
        port map (
            x_i => x_reg,
            y_i => y_reg,
            cases_i => cases,
            red_o => vga_red_o,
            green_o => vga_green_o,
            blue_o => vga_blue_o
        );

end Behavioral;
