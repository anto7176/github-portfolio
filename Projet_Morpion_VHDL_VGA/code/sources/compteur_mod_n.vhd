library IEEE;
use IEEE.STD_LOGIC_1164.ALL;


entity compteur_mod_n is
    generic (
        n : integer
    );
    port (
        clk_i : in std_logic;			-- Clock
        reset_i : in std_logic;			-- Remise à zéro du compteur en cas de réinitialisation
        count_o : out integer range 0 to n;	-- Valeur actuelle du compteur
        reset_o : out std_logic			-- Impulsion quand le compteur atteint sa valeur maximale
    );
end compteur_mod_n;


architecture Behavioral of compteur_mod_n is
signal count_reg : integer range 0 to n;

begin
    count_add : process(clk_i, reset_i)
    begin
        if reset_i = '1' then
            count_reg <= 0;	-- Remise à zéro du compteur en cas de reset
        end if;
        if rising_edge(clk_i) then		-- Sur chaque fronts montants
            if  count_reg = n-1 then		-- Si on est à la fin du compteur
                count_reg <= 0;			-- Remise à zéro
                reset_o <= '1';			-- Envoie de l'impulsion 
            else 				-- Si on n'est pas à la fin du compteur
                count_reg <= count_reg + 1;	-- Incrémentation du compteur
                reset_o <= '0';			-- On s'assure que reset_o est remis à zéro
            end if;
        end if;
           
    end process count_add;
    
    count_o <= count_reg; -- Attribue la valeur actuelle du compteur à la sortie count_o de l'entité
    
end Behavioral;
