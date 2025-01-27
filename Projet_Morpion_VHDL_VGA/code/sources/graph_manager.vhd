library IEEE;
use IEEE.STD_LOGIC_1164.ALL;

entity graph_manager is 
    port (
        x_i, y_i : in integer range 0 to 799; 			-- La position actuelle du spot de l'écran vga imposé par le vga_sync
        cases_i : in std_logic_vector(17 downto 0); 		-- Le tableau avec la la valeur de chaque cases : "00" => vide, "01" => croix, "10" => carre
        red_o : out std_logic_vector(3 downto 0);		-- 4 bits pour la couleur rouge du pixel de coordonée (x_i, y_i)
        green_o : out std_logic_vector(3 downto 0); 		-- De même pour le vert
        blue_o : out std_logic_vector(3 downto 0)		-- de même pour le bleu
    );
end graph_manager;

architecture behavior of graph_manager is
signal x, y, case_size, margin, border, size : integer range 0 to 512; -- Paramètres de la grille

begin
    x <= 375; 		-- Position x de la grille
    y <= 200;		-- Position y de la grille
    case_size <= 50; 	-- Taille de chaque case
    margin <= 3;	-- Taille de la marge entre les cases et la grille
    border <= 4; 	-- Epaisseur de la grille

    size <= 3*case_size + 4*margin + 2*border; -- Taille totale de la grille

    process(x_i, y_i, x, y, case_size, margin, border, cases_i) -- Process qui gère les conditions d'affichage. Autrement dit des conditions sur x et y pour définir la
    variable temp : integer range 0 to 512; 			-- couleur des pixels de sorties
    variable x_cases, y_cases : integer range 0 to 512;		
    variable x_cercle_center, y_cercle_center, r_cercle : integer range 0 to 512;
    variable q_reg, r_reg : integer range 0 to 512;
    variable h : integer range 0 to 512;
    
    begin
        for i in 1 to 2 loop -- Boucle pour l'affichage de la grille
            temp := i*case_size + (2*i - 1)*margin + (i-1)*border; -- Une variable temporaire car répetée beaucoup de fois.

            if x_i > x + temp            and -- Première condition pour l'affichage des barres verticales de la grille
               x_i < x + temp + border  and
               y_i > y                  and
               y_i < y + size           then
                red_o <= "1111";
                green_o <= "1111";
                blue_o <= "1111";
            end if;

            if y_i > y + temp           and -- Condition pour l'affichage des barres horizontales de la grille
               y_i < y + temp + border  and
               x_i > x                  and
               x_i < x + size           then
                red_o <= "1111";
                green_o <= "1111";
                blue_o <= "1111";
            end if;

        end loop;
                
        for i in 1 to 3 loop -- Boucles pour l'affichage des croix et des ronds où le couple (i, j) de [1, 3]x[1, 3] est la case sélectionné de la grille
            for j in 1 to 3 loop
                x_cases := x + (i-1)*(case_size + 2*margin + border); -- Coordonnée x de la case en question
                y_cases := y + (j-1)*(case_size + 2*margin + border); -- Coordonnée y de la case en question

                if x_i > x_cases              and -- Première condition qui teste si le spot de l'écran est dans la case pour renvoyer d'autre couleurs que noir
                   x_i < x_cases + case_size  and 
                   y_i > y_cases              and
                   y_i < y_cases + case_size  then

                    if cases_i((i + 3*(j-1))*2 - 2) = '1' then -- Condition qui vérifie si la case (i, j) contient une croix
                        if x_i - x_cases = y_i - y_cases or			-- Utilise en suite les équation y = x et y = -x avec des ajustement pour tracer la croix 
                           x_i - x_cases - case_size = y_cases - y_i then
                            red_o <= "0000";
                            green_o <= "0000";
                            blue_o <= "1111";					-- De couleur bleu
                        else 							-- Sinon si pas sur la croix alors on met du noir
                            red_o <= "0000";
                            green_o <= "0000";
                            blue_o <= "0000";
                        end if;
                    end if;

                    if cases_i((i + 3*(j-1))*2 - 1) = '1' then -- Condition qui vérifie si la case (i, j) contient un rond mais trace un carre vide pour simplifier.
                        if x_i > x_cases+2              and 	-- Test si on est dans le carre au quel cas c'est noir
                           x_i < x_cases + case_size-1  and
                           y_i > y_cases+2              and
                           y_i < y_cases + case_size-2  then
                            red_o <= "0000";
                            green_o <= "0000";
                            blue_o <= "0000";
                        else 				    	-- Sinon trace la bordure rouge du carre
                            red_o <= "1111";
                            green_o <= "0000";
                            blue_o <= "0000";
                        end if;
                    end if;

                    if cases_i((i + 3*(j-1))*2 - 2) = '0' and cases_i((i + 3*(j-1))*2 - 1) = '0' then -- Si la case est vide alors on renvoie du noir
                        red_o <= "0000";
                        green_o <= "0000";
                        blue_o <= "0000";
                    end if;

                  elsif x_i > x_cases - margin           and 		-- Dernière condition pour envoyer du noir lorsque le spot se trouve sur la zone de la marge 
                        x_i < x_cases + case_size + margin    and	-- entre la grille et les cases
                        y_i > y_cases - margin           and
                        y_i < y_cases + case_size + margin    and
                        (x_i < x_cases           or
                         x_i > x_cases + case_size    or
                         y_i < y_cases           or
                         y_i > y_cases + case_size    )       then
                            red_o <= "0000";
                            green_o <= "0000";
                            blue_o <= "0000";
                 
                   end if;
            
            end loop;
        end loop;

        if x_i < x          or -- Finalement, si on est pas dans la grille alors la couleur envoyé est le noir
           x_i > x + size   or
           y_i < y          or
           y_i > y + size   then
            red_o <= "0000";
            green_o <= "0000";
            blue_o <= "0000";
        end if;
    end process;

end behavior;
                        
                    

