 <?php 
$nb = 1;
while ($hum = $humidite -> fetch()) {?> 
           
            <div class="capteur">

            <h3 class="titre"> Humidité <?php echo $nb?></h3>

            <img src="<?php echo $hum['photo']?>" class="avatar_capteur">

            <div class="range">
              <input type="range" name="eau" min="0" max="100" step="1" class="curseur" list="tickmarks">
            </div>
            <datalist id="tickmarks">
              <option value="0" label="0%">
                <option value="10">
                  <option value="20">
                    <option value="30">
                      <option value="40">
                        <option value="50" label="50%">
                          <option value="60">
                            <option value="70">
                              <option value="80">
                                <option value="90">
                                  <option value="100" label="100%">
                                  </datalist>

                                </div>

<?php $nb = $nb + 1; }?>
 
