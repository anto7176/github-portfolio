library IEEE;
use IEEE.STD_LOGIC_1164.ALL;

-- Déclaration de l'entité game_manager qui permet de gèrer la machine à états du jeu
entity game_manager is
    port (
        choice_i : in std_logic_vector(8 downto 0) := "000000000";  -- Entrée pour indiquer la case choisie par le joueur (9 bits car 9 cases)
        cases_o : out std_logic_vector(17 downto 0) := "000000000000000000"; -- Sortie indiquant l'etat actuel des cases (00 : vide , 01 : croix bleue , 10 : carré rouge)
        btn_valid_i : in std_logic;  -- bouton de validation du coup joué
        reset_i : in std_logic; 
        clk_i : in std_logic
    );

end game_manager;



architecture Behavioral of game_manager is

type state_t is (j1,valid_j1,j2, valid_j2,win,draw);
signal changed_bit_index : integer range 0 to 8; -- indice de la case sélectionnée par le joueur
signal cases_full : std_logic := '0'; -- indicateur si toutes les cases sont pleines
signal state_next, state_reg : state_t;
signal cases : std_logic_vector(17 downto 0) := "000000000000000000"; -- état des cases (croix,carré,vide)



begin    
    
    process(clk_i, reset_i)
        variable active_bits : integer;  -- variable pour compter les bits actif dans choice_i
    begin
        if reset_i = '1' then  --reset du jeu 
            state_reg <= j1;
            cases <= "000000000000000000";
        elsif rising_edge(clk_i) then --gestion des transistions des états à chaque fronts montant de la clock
            state_reg <= state_next;
            
            case state_reg is -- MAE
       
            when j1 =>      -- Etat ou le joueur n°1 sélectionne une case
                if (btn_valid_i ='1') then 
                    active_bits := 0;
                    for i in 0 to 8 loop -- On compte le nombre de cases sélectionnée (1 seule)
                        if choice_i(i) = '1' then
                            active_bits := active_bits + 1;
                            changed_bit_index <= i;  --On stock l'indice de la case sélectionnée
                        end if;
                    end loop;
                
                    -- Condition pour que le coup soit validée
                    if ((btn_valid_i ='1') and (cases(changed_bit_index*2) = '0') and (cases((2*changed_bit_index)+1) = '0') and active_bits = 1) then
                            state_next <= valid_j1;
                    else
                        state_next <= j1;
                    end if;
                else 
                    state_next <= j1;
                end if;
               
            when valid_j1 =>  -- Etat de validation du tour du joueur n°1
                cases(((changed_bit_index)*2)) <= '1'; --Enregistrement de la croix
                if cases = "XXXXXXXXXXXX010101" or  -- Verification si il y a une victoire avec les 9 combinaisons possibles
                   cases = "XXXXXX010101XXXXXX" or
                   cases = "010101XXXXXXXXXXXX" or
                   cases = "XXXX01XXXX01XXXX01" or
                   cases = "XX01XXXX01XXXX01XX" or
                   cases = "01XXXX01XXXX01XXXX" or
                   cases = "XXXX01XX01XX01XXXX" or
                   cases = "01XXXXXX01XXXXXX01" then
                        state_next <= win;
                elsif cases_full = '1' then --Vérification du match nul
                    state_next <= draw;
                else 
                    state_next <= j2;
                end if;
               
            when j2 =>  -- Etat ou le joueur n°2 sélectionne une case
                if (btn_valid_i ='1') then  
                    active_bits := 0;
                    for i in 0 to 8 loop -- On compte le nombre de cases sélectionnée (1 seule)
                        if choice_i(i) = '1' then
                            active_bits := active_bits + 1;
                            changed_bit_index <= i; --On stock l'indice de la case sélectionnée
                        end if;
                    end loop;
                
                    -- Condition pour que le coup soit validée
                    if ((btn_valid_i ='1') and (cases(changed_bit_index*2) = '0') and (cases((2*changed_bit_index)+1) = '0') and active_bits = 1) then
                            state_next <= valid_j2;
                    else
                        state_next <= j2;
                    end if;
                else 
                    state_next <= j2;
                end if;         
                  
            when valid_j2 => -- Etat de validation du tour du joueur n°2
                cases(((changed_bit_index)*2)+1) <= '1'; --Enregistrement du carré rouge
                if cases = "XXXXXXXXXXXX101010" or -- Verification si il y a une victoire avec les 9 combinaisons possibles
                   cases = "XXXXXX101010XXXXXX" or
                   cases = "101010XXXXXXXXXXXX" or
                   cases = "XXXX10XXXX10XXXX10" or
                   cases = "XX10XXXX10XXXX10XX" or
                   cases = "10XXXX10XXXX10XXXX" or
                   cases = "XXXX10XX10XX10XXXX" or
                   cases = "10XXXXXX10XXXXXX10" then
                     state_next <= win;
               elsif cases_full = '1' then --Vérification du match nul
                    state_next <= draw;
               else 
                    state_next <= j1;
               end if;
            
            -- État de victoire, le jeu est bloqué jusqu'à un reset.
            when win =>
                    if reset_i = '1' then
                        state_next <= j1;
                    else 
                        state_next <= win;
                    end if;
                    
            -- État de match nul : le jeu est bloqué jusqu'à un reset.
            when draw =>
                    if reset_i = '1' then
                        state_next <= j1;
                    else 
                        state_next <= draw;
                    end if;
         end case;
      end if;
end process;  

cases_o <= cases;  -- Liaison des cases internes à la sortie du composant.

end Behavioral;