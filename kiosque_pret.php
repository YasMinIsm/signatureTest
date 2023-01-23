<?php /** @var kiosque_loan_fusion $this */;?>
<script>
    function savePretForm() {
        document.getElementById('pretFormSrv').value = 'ActionKiosquePret';
        document.getElementById('pretFormOp').value = 'saveInfoPret';
        document.getElementById('pretForm').submit();    
    }
    // function hideConfirmData(){
    //     document.getElementById('idOverlay').style.display = "block";
    //     setTimeout(closeWindows, 300);
    // }
    //   // Retour a la page kiosque_pret
    //   function closeWindows(){
    //     location.href = "<?=$GLOBALS['CONF']['appli']['url']?>KiosquePret/Show";
    // }
</script>
<!-- <style>
    /*la signature et le commentaire */
    /* .col-xs-right{
        float:right;
        width:50%;
    }
    .col-xs-left{
        float:left;
        width:50%;
    } */
    /* liste dans cgp
    li{
        margin-bottom: 5px !important;
    } */

/* responsive unique à ce formulaire */
    @media screen and (min-width:1024px) and (max-width:1366px){
    /* .navigation .body-navigation .optionForms,
    .navigation .body-navigation .form-group{
        margin: 10px 15% 10px 15%;
        height: 65vh;
    } */
    /* div.col-xs-right , div.col-xs-left{
        width:100%;
    } */
   /* .form-footer-left, .form-footer-right{
        margin-top:-5% !important;
    }  */
    /* .col-xs textarea, .col-xs canvas{
        width: 60% !important;
    } */
}
</style> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style type="text/css">
    .formdata{margin-bottom: 10px; display:block;}
    .formdata > label {display:block; margin-bottom: 5px;}
    .formdata > select{width:180px;}
    .formdata > input, .formdata >select{padding:3.5px;border-radius:7px;border:0.5px solid grey;min-height:24px;;}
    .formdata > button, .form-footer-right > button{padding:10px 20px;border-radius:7px;border:none;color:white;margin:3px}
    #SInputDate{color:var(--color-dark-grey);margin-top:-5px !important;padding:3.5px;border-radius:7px;border:0.5px solid grey;}
    #inputMessage{height:60px;width:250px;border-radius:7px;padding:7px}
    input::placeholder, textarea::placeholder{color:black;opacity:1;}
    #bntGoToTop {display: none;position: fixed;bottom: 20px;right: 30px;z-index: 3;font-size: 18px;border: none;outline: none;background-color: var(--theme-sidebar);color: white;cursor: pointer;padding: 15px;border-radius: 4px;}
    #bntGoToTop:hover {background-color: var(--theme-color);}
</style>

<div class="overlayForm" id="idOverlay" style="display:none; overflow: scroll;">
    <div class="popup center" id="popupForm" style="height:115vh;width:660px;top:65% !important;">
        <div class="icon">
            <img src="<?=$GLOBALS['CONF']['appli']['url']?>images/icons/modify.png"/>
        </div>
        <div class="title">
            Prêt
        </div>
        <div class="description"></div>
        <form id="modifyForm" method="POST" action="main.php">
            <input type="hidden" id="modifyFormSrv" name="srv">
            <input type="hidden" id="modifyFormOp" name="op">
            <input type="hidden" name="idPret">
            <div class="form-group" >
                <div class="form-modify" style="text-align:left !important; display:block !important;">
                  <!-- Right column -->
                  <div class="col-xs-r2" style="text-align:left !important; display:block !important;">
                  <div class="formdata">
                        <label for="SInputDate">Date</label>
                        <input name="dtDate" class="form-content" id="SInputDate" readonly style="color:var(--color-dark-grey)" value="<?=date("Y-m-d");?>" />
                    </div>
                        <div class="formdata" >
                            <label for="SInputTech" >Technicien</label>
                            <input type="text" name="lbTechnicien" class="form-content" id="SInputTech" placeholder="Technicien" readonly/>
                        </div>
                        <div class="formdata" >
                            <label for="SInputMat" id="inputMat">Code inventaire</label>
                            <input type="text" name="lbMat" class="form-content" id="SInputMat" readonly placeholder="Code inventaire"/>
                        </div>
                    </div>
                    <!-- left column -->
                    <div class="col-xs-l2" style="float:none;height:auto;">
                        <div class="formdata">
                            <label for="SInputkey" >Ticket</label>
                            VIGIE- <input type="text" name="lbTicket" class="form-content" id="SInputkey" placeholder="Num" style="width:60px" maxlength="6" readonly>
                        </div>
                        <div class="formdata">
                        <label for="SInputClaimant">Demandeur*</label>
                        <input name="lbClaimant" class="form-content" id="SInputClaimant"  list=collaborateurList placeholder="Nom d'utilisateur" readonly style="width:70% !important;" onchange="Verify()">
                        <datalist id=collaborateurList>
                            <?foreach ($this->listeCollaborateurs as $collaborateurs){?>
                                <option><?=utf8_decode($collaborateurs['lb_nom_prenom_concat']);?></option>
                            <? } ?>
                            <option>ADOMA Galaxie</option>
                        </datalist>  
                            </div>
                        <div class="formdata">
                            <label for="inputDuration" id="inputDuration">Durée</label>
                            <input type="text" name="lbDuration" class="form-content" id="inputDuration" readonly placeholder="Durée du prêt" >
                        </div>
                        <div class="formdata" >
                            <label for="inputMessage">Commentaire</label>
                            <textarea name="lbCommentaire" id="inputMessage" placeholder="Taper ici votre commentaire..." style="width:50vh !important; height: 20vh !important;"></textarea>

                            <?php if(!empty($this->datas['dtDateDerniereModification']) || !empty($this->datas['lbModifierPar'])){
                                echo "<h5 style=\"text-align:right;margin-top:5px;font-size:small;\">Derniére modification le: ".$this->datas['dtDateDerniereModification']." | Par : ".$this->datas['lbModifierPar']."</h5>";
                            }?>
                        </div>
                        <div class="formdata">
                            <label for="SCanvasSign" >Signature de prêt*</label>
                            <canvas  name="lbSignature" class="form-content" id="SCanvasSign" ></canvas>
                        </div>
                        <div class="formdata">
                            <button type="button" id="ResetSign" class="ResetSign" >Effacer</button>
                        </div>
                        <div class="formdata" style=" float:left !important; width:45vh !important; display:flex; align-items: center;"> 
                            <input type="checkbox" id="SChbxCGP" >
                            <a href="#" title="" onclick="unhideCgp()" style="color: black; margin-left: 5px;"> J'accepte les conditions générales de prêt 
                            <img src="<?=$GLOBALS['CONF']['appli']['url']?>images/icons/info.png" style="height:15px;width:15px; margin-right:2px;margin-bottom: 0px !important;"/>
                            </a>
                        </div> 
                    </div>  
                   
                    <div class="col-xs" style="display: none; padding: 0; margin-bottom: 10% !important;" id="idRestitution" > 
                        <div class="formdata">
                            <label for="SCanvasSignR" >Signature de restitution*</label>
                            <canvas  name="lbSignatureR" class="form-content" id="SCanvasSignR" ></canvas>
                        </div>
                        <div class="formdata">
                            <button type="button" id="ResetSignR" class="ResetSignR">Effacer</button>
                            <button type="button" id="ResetSignR" class="ResetSignR" onclick="hideRestitution()" style="background-color: cadetblue;">Cacher </button>
                        </div>
                    </div> 
                <div class="form-footer" style="margin-top: 20% !important;">
              
                    <div class="form-footer-left" style="text-align:left;color:red">
                        <h6>(*) champs obligatoire</h6>
                    </div>
                    <div class="form-footer-right" style="text-align:right">
                        <button type="button" onclick="SignRestitution()" name="restituter" id="" style="background-color:green;">Restituer</button>
                        <button type="button" onclick="hideFormPret()" name="Annuler" id="" style="background-color:var(--color-red);">Annuler</button>     
                        <button type="button" onclick="updateModifyPret()" name="valider" id="" style="background-color:var(--color-blue-soft);">Modifier</button> 
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
    <!-- popup de validation d'enregistrement -->
    <div class="popup center" id="popupCheck"style="box-shadow: var(--box-shadow);display:none;">
        <div class="icon">
            <img src="<?=$GLOBALS['CONF']['appli']['url']?>images/icons/check.png"/>
        </div>
        <div class="title" >
            Succès !!
        </div>
        <div class="description" style="margin-top:15%;">
            Les données du formulaire ont été enregistées avec succès
        </div>
        <!-- <div class="dismiss-bnt">
            <button id="dismiss-popup-bnt" onclick="closeWindows()">Fermer</button>
        </div> -->
    </div>
                        
    <div class="forbidden center" id="popupDelete" style="box-shadow: var(--box-shadow);display:none;">
        <div class="icon">
            <img src="<?=$GLOBALS['CONF']['appli']['url']?>images/icons/bin.png"/>
        </div>
        <div class="title">
            Restitution !!
        </div>
        <div class="description">
            <h4>Confirmez-vous la réstitution ?</h4>
            <h5 style="color:#F74F4F;text-align:left; background-color:#FECACA;border-radius:7px;padding:7px;margin-top:7px;">Information :</br>Toute suppression est définitive, aucune donnée ne pourra être restaurée.</h5>
        </div>
        <form id="deleteInfo" method="POST" action="main.php">
            <input type="hidden" id="deleteInfoSrv" name="srv">
            <input type="hidden" id="deleteInfoOp" name="op">
            <input type="hidden" name="idActivite">
        </form>
        <div class="dismiss-bnt">
            <button id="dismiss-popup-bnt" onclick="closeWindows()">Annuler</button>
            <button id="dismiss-popup-bnt-2" onclick="confirmeRestitution()">Confirmer</button>    
        </div>
    </div>

    <div class="popup center" id="popupConfirmeRestitution" style="box-shadow: var(--box-shadow);display:none;">
    <div class="icon">
        <img src="<?=$GLOBALS['CONF']['appli']['url']?>images/icons/check.png"/>
    </div>
    <div class="title">
        Réstitution
    </div>
    <div class="description" style="margin-top:15%;">
        Le prêt à été réstitué avec succès.
    </div>
</div>
</div>
<!-- Overlay cgp -->
<div class="overlayForm" id="idOverlayCgp" style="display:none;"> 
    <!-- popup de validation des cgp -->  
     <div class="popup" id="popup">
        <div class="content">
       <?php include("CGP.html"); ?>
            <button onclick="hideCgp()" id="CloseCgp"> J'ai compris</button>
        </div>
    </div>
</div>
</div>

<div class="navigation" style="background-image:url(<?=$GLOBALS['CONF']['appli']['url']?>images/18410.jpg);background-size: cover;">
<!--------------------- NAV-BAR -------------------------->
<?php include ('commun/nav_bar_cds.php');?>
<!------------------- END NAV-BAR ------------------------>
    <div class="body-navigation" id="blur" >
        <?$debug = 0; 
        if ($debug==1){
            echo "<pre>";print_r($GLOBALS['_POST']);echo"</pre>";
        }
        ?>
            <!-- <div class="optionForms">
                <h3>Sélectionner le type de saisie :</br></h3>
                <button id="bntSimpleForm" onclick="javascript:
                    document.getElementById('simpleForm').style.display = 'block';
                    document.getElementById('lotForm').style.display = 'none';
                    document.getElementById('qrForm').style.display = 'none';
                    document.getElementById('tbLotForm').style.display = 'none';
                    document.getElementById('LotForms').style.display = 'none';
                    document.getElementById('tbLotForms').style.display = 'none';">Simple
                </button>
                <button id="bntLotForm" onclick="javascript:
                    document.getElementById('simpleForm').style.display = 'none';
                    document.getElementById('lotForm').style.display = 'block';
                    document.getElementById('qrForm').style.display = 'none';
                    document.getElementById('tbLotForm').style.display = 'block';
                    document.getElementById('LotForms').style.display = 'block';
                    document.getElementById('tbLotForms').style.display = 'block';">En lot
                </button> 
                <button id="bntqrForm" onclick="javascript:
                    document.getElementById('simpleForm').style.display = 'none';
                    document.getElementById('lotForm').style.display = 'none';
                    document.getElementById('qrForm').style.display = 'block';
                    document.getElementById('tbLotForm').style.display = 'none';
                    document.getElementById('LotForms').style.display = 'none';
                    document.getElementById('tbLotForms').style.display = 'none';">QR code
                </button>
            </div> -->
        <!-- Formulaires -->
        <!-- <?php 
            // include ('forms/simpleForms.php');
            // include ('forms/lotForms.php');
        ?>  -->
    <form id="simpleForm" method="post" class="form" action="main.php">  <!--style="display:none"-->
        <input type="hidden" id="simpleFormSrv" name="srv">
        <input type="hidden" id="simpleFormOp" name="op">
        <div class="form-group" >
            <div class="form-title">
                <h2>Formulaire de saisie</h2>
                <h4>Prêt de matériel</h4>
            </div>
            <div class="form-content">
                 <!-- left column -->
                 <div class="col-xs-l2" style="height:200px !important; ">
                    <div class="formdata">
                        <div class="tooltip">
                            <label for="SInputKey">Numéro de ticket*</label>
                            <p style="margin-left:15px;">VIGIE- <input type="number" min="0" name="lbTicket" class="form-content" id="SInputKey" placeholder="Réf. VIGIE" style="margin-left:0;" maxlength=5 onchange="Verify()" /></p>
                            <span class="tooltiptext">Numéro de ticket au format numérique "xxxxx"</span>
                        </div>
                    </div>
                    <div class="formdata">
                        <label for="SInputClaimant">Demandeur*</label>
                        <input name="lbClaimant" class="form-content" id="SInputClaimant"  list=collaborateurList placeholder="Nom d'utilisateur" style="width:230px !important;" onchange="Verify()">
                        <datalist id=collaborateurList>
                            <?foreach ($this->listeCollaborateurs as $collaborateurs){?>
                                <option><?=utf8_decode($collaborateurs['lb_nom_prenom_concat']);?></option>
                            <? } ?>
                            <option>ADOMA Galaxie</option>
                        </datalist>  
                    </div>
                    <div class="formdata" id="suffix">
                        <label for="SInputDuration">Durée*</label>
                        <input type="number" name="lbDuration" min=1 max=7 class="form-content" id="SInputDuration" placeholder="Durée du prêt" onchange="Verify()">
                    </div>
                </div>  
                <!-- Right column -->
                <div class="col-xs-r2" style="height:200px !important;">
                    <div class="formdata">
                        <label for="SInputDate">Date</label>
                        <input name="dtDate" class="form-content" id="SInputDate" readonly style="color:var(--color-dark-grey)" value="<?=date("Y-m-d");?>" />
                    </div>
                    <div class="formdata">
                        <label for="SInputTech">Remis par</label>
                        <input  name="lbTechnicien" class="form-content" id="SInputTech" value="<?=$_SESSION['utilisateur']->lbShortLogin ;?>" readonly />
                    </div>
                    <div class="formdata">
                        <label for="SInputMat">Matériel</label>
                        <input type="text" name="lbMat" class="form-content" id="SInputMat" placeholder="Code inventaire">
                    </div>
                </div>
                <div class="col-xs" > 
                    <!-- <div class="col-xs-left">
                    <div class="formdata">
                        <label for="SCanvasSign" >Signature*</label>
                        <canvas  name="lbSignature" class="form-content" id="SCanvasSign" onchange="Verify()"></canvas>
                    </div>
                    <div class="formdata">
                        <button type="button" id="ResetSign" class="ResetSign">Effacer</button> -->
                        <!-- <button type="button" id="SubmitSign" onclick="verifier()" >Vérifier</button> -->
                    <!-- </div>
                    </div> -->
                    <!-- <div class="col-xs-right"> -->
                    <div class="formdata">
                        <label for="SInputMessage">Commentaire</label>
                        <textarea name="lbMessage" id="SInputMessage" placeholder="Tapez ici votre commentaire ..." style="resize: none;"></textarea>
                    </div>
                <!-- <div class="formdata" >
                        <input type="checkbox" id="SChbxCGP" onclick="Verify()">
                        J'accepte <a href="#"  title=" " onclick="unhideCgp()" style=" color: black;">les conditions générales de prêt 
                        <img src="<?=$GLOBALS['CONF']['appli']['url']?>images/icons/info.png" style="height:18px;margin-right:2px;"/>
                        </a>
                     </div>    -->
                    <!-- </div>        -->
                </div>
            <div class="form-footer" >
                <div class="form-footer-left">
                    <h6>(*) champs obligatoire</h6>
                </div>
                <div class="form-footer-right">
                    <button onclick="unhideFormPret()">overlay</button>
                    <button type="submit"  name="Submit" id="BtnSubmit" onclick="savePretForm()" disabled="disabled" style="background-color: rgb(33, 104, 145) !important;">Prévalider</button> 
                    <button type="reset" id="BtnReset" onclick="ResetAll()">Annuler</button> 
                </div>
            </div>
        </div>
    </form>
        <!-- Fin Formulaires-->
    </div> <!-- body-navigation -->
</div> <!--navigation -->
<!--Popup-->
<script>
    //générer un pdf

    // function PDF() {
    //     var date_pdf = document.getElementById('SInputDate').value;
    //     var ticket_pdf = document.getElementById('SInputKey').value;
    //     var claimant_pdf = document.getElementById('SInputClaimant').value;
    //     var mat_pdf = document.getElementById('SInputMat').value;
    //     var tech_pdf = document.getElementById('SInputTech').value;
    //     var duration_pdf = document.getElementById('SInputDuration').value;
    //     var message_pdf = document.getElementById('SInputMessage').value;
    //     var cgp_pdf = document.getElementById('SChbxCGP');

    //     var body_pdf = document.querySelector('body');

    // //insertion

    //     body_pdf.innerHTML = `<div class="form-pdf">
    //                         <div class="logo">
    //                             <img src="<?=$GLOBALS['CONF']['appli']['url']?>images/logo.bmp">
    //                         </div>
    //                         <div class="form-title-pdf">
    //                             <h4>Prêt de matériel</h4>
    //                         </div>
    //                             <div class="form-content-pdf">
    //                                 <div class="formdata">
    //                                     <label for="SDate">Date : </label>
    //                                     ${date_pdf}
    //                                 </div>
    //                                 <div class="formdata">
    //                                         <label for="SKey">Numéro de ticket : </label>
    //                                         VIGIE- ${ticket_pdf}     
    //                                 </div>
    //                                 <div class="formdata">
    //                                     <label for="SClaimant">Demandeur : </label>
    //                                     ${claimant_pdf}
    //                                 </div>
    //                                 <div class="formdata">
    //                                     <label for="StMat">Matériel : </label>
    //                                     ${mat_pdf}
    //                                </div>
    //                                 <div class="formdata">
    //                                     <label for="STech">Remis par : </label>
    //                                     ${tech_pdf}
    //                                 </div>
    //                                 <div class="formdata">
    //                                     <label for="SDuration">Durée : </label>
    //                                     ${duration_pdf} jour(s)                
    //                                 </div>
    //                                 <div class="formdata"  >
    //                                     <label for="SMessage">Commentaire</label>
    //                                     ${message_pdf}
    //                                 </div>
    //                                 <div class="formdata" >
    //                                     <input type="checkbox" id="SChbxCGP"  checked="checked" onclick="Verify()" disabled>
    //                                     Conditions générales de prêt acceptées
    //                                 </div>  
    //                                 <div class="formdata">
    //                                     <label for="SSign" >Signature : </label>
    //                                     <p></p>
    //                                 </div>     
    //                             </div>
    //                     </div>
    //                     `
    //                      const pdf = document.querySelector(".form-pdf");
    //                      html2pdf()
    //                      .from(pdf)
    //                      .save
    //                     }

    //afficher cgp

    function unhideFormPret(){
        document.getElementById('idOverlay').style.display = "block";
    }
    function hideFormPret(){
        document.getElementById('idOverlay').style.display = "none";
    }
    function unhideCgp(){
        document.getElementById('idOverlayCgp').style.display = "block";
    }
    function hideCgp(){
        document.getElementById('idOverlayCgp').style.display = "none";
    }
    function SignRestitution(){
        document.getElementById('idRestitution').style.display = "block";
        document.getElementById('popupForm').style.height = "145vh";
        document.getElementById('popupForm').style.top = "80%";

    }
    function hideRestitution(){
        document.getElementById('idRestitution').style.display = "none";
        document.getElementById('popupForm').style.height = "115vh";
        document.getElementById('popupForm').style.top = "65%";
    }

    // function hideConfirmData(){
    //     document.getElementById('idOverlay').style.display = "block";
    //     setTimeout(closeWindows, 300);
    // }

    //vérifier si canvas est vide

    // function isCanvasEmpty(canvas) {
    //     const blankCanvas = document.createElement('canvas');
    //     blankCanvas.width = canvas.width;
    //     blankCanvas.height = canvas.height;
    //     return canvas.toDataURL() === blankCanvas.toDataURL();
    // }

    //DESACTIVER LE BOUTON EN FONCTION DU CHECKBOX ET LES CHAMPS VIDES
    function Verify() {
        // chbx = document.getElementById('SChbxCGP');
        demandeur = document.getElementById('SInputClaimant').value;
        codeM = document.getElementById('SInputKey').value;
        duree = document.getElementById('SInputDuration').value;
        // materiel = document.getElementById('SInputMat').value;
        // signature = document.getElementById('SCanvasSign');      
        reset = document.getElementById('reset');
        
         //&& materiel!="" && chbx.checked == 1 &&!isCanvasEmpty(signature) 
         if (demandeur!="" && codeM!="" && duree!=""){
            document.getElementById('BtnSubmit').disabled = 0;
            // signature.style.border = "3px solid #5CCE5A ";
        }
        else{
            document.getElementById('BtnSubmit').disabled = 1 ;
        }
    }
    //Bouton annuler
    function ResetAll() {
        document.getElementById('BtnSubmit').disabled = 1;
        // ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    //Dessiner une signature et l'effacer    
    const canvas = document.getElementById("SCanvasSign");
    const form = document.querySelector('.form');
    const clearButton = document.querySelector('.ResetSign');
    const ctx = canvas.getContext('2d');
    let writingMode = false;

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        // invalide
        // const imageURL = canvas.toDataURL("image/png");
        // document.getElementById("SCanvasSign").value = imageURL;
        // const image = document.createElement('img');
        // image.src = imageURL;
        // image.height = canvas.height;
        // image.width = canvas.width;
        // image.style.display = 'block';
        // form.appendChild(image);

        // var sign = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
        // window.location.href=sign+".png";
        // saveAs(sign + ".png");

        // // // télécharger la signature (valide)//////////////////////////////////////////

        // var Scanvas = document.getElementById('SCanvasSign');
        // var link = document.createElement("a");
        // nom = "SIGN";
        // ticket =  document.getElementById("SInputKey").value;
        // extension =".png";
        // link.download = nom+ticket+extension;
        // link.href = Scanvas.toDataURL("image/png");
        // document.body.appendChild(link);
        // link.click();
        // document.body.removeChild(link);
	    // delete link;
        // clearPad();
    })
    const clearPad = () => {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        // document.getElementById('BtnSubmit').disabled = 1;
        canvas.style.border = "var(--color-grey-soft) solid .5px";
    }
    clearButton.addEventListener('click', (event) => {
        event.preventDefault();
        clearPad();
    }) 
    const getTargetPosition = (event) => {
        positionX = event.clientX - event.target.getBoundingClientRect().x;
        positionY = event.clientY - event.target.getBoundingClientRect().y;

        return [positionX, positionY];
    }
    const handlePointerMove = (event) => {
        if(!writingMode) return
        const [positionX, positionY] = getTargetPosition(event);
        ctx.lineTo(positionX, positionY);
        ctx.stroke();
    }
    const handlePointerUp = () => {
        writingMode = false;
    }
    const handlePointerDown = (event) => {
        writingMode = true;
        ctx.beginPath();

        const [positionX, positionY] = getTargetPosition(event);
        ctx.moveTo(positionX, positionY);
    }
    ctx.lineWidth = 2;
    ctx.lineJoin = ctx.lineCap = 'round';
    ctx.strokeStyle = "black"
    
    canvas.addEventListener("mouseup", () => {
         writingMode = false
        })
    canvas.addEventListener("mouseout", () => {
        writingMode = false
        })

    canvas.addEventListener('pointerdown', handlePointerDown, {passive: true});
    canvas.addEventListener('pointerup', handlePointerUp, {passive: true});
    canvas.addEventListener('pointermove', handlePointerMove, {passive: true});


    const canvasR = document.getElementById("SCanvasSignR");
    const formR = document.getElementById('idRestitution');
    const clearButtonR = document.querySelector('.ResetSignR');
    const ctxR = canvasR.getContext('2d');

  
    const clearPadR = () => {
        ctxR.clearRect(0, 0, canvasR.width, canvasR.height);
        // document.getElementById('BtnSubmit').disabled = 1;
        canvasR.style.border = "var(--color-grey-soft) solid .5px";
    }
    clearButtonR.addEventListener('click', (event) => {
        event.preventDefault();
        clearPadR();
    }) 
    const getTargetPositionR = (event) => {
        positionXR = event.clientXR - event.target.getBoundingClientRect().x;
        positionYR = event.clientYR - event.target.getBoundingClientRect().y;

        return [positionXR, positionYR];
    }
    const handlePointerMoveR = (event) => {
        if(!writingMode) return
        const [positionXR, positionYR] = getTargetPosition(event);
        ctxR.lineTo(positionXR, positionYR);
        ctxR.stroke();
    }
    const handlePointerUpR = () => {
        writingMode = false;
    }
    const handlePointerDownR = (event) => {
        writingMode = true;
        ctxR.beginPath();

        const [positionXR, positionYR] = getTargetPosition(event);
        ctxR.moveTo(positionXR, positionYR);
    }
    ctxR.lineWidth = 2;
    ctxR.lineJoin = ctxR.lineCap = 'round';
    ctxR.strokeStyle = "black"
    
    canvasR.addEventListener("mouseup", () => {
         writingMode = false
        })
    canvasR.addEventListener("mouseout", () => {
        writingMode = false
        })

    canvasR.addEventListener('pointerdown', handlePointerDownR, {passive: true});
    canvasR.addEventListener('pointerup', handlePointerUpR, {passive: true});
    canvasR.addEventListener('pointermove', handlePointerMoveR, {passive: true});


</script>