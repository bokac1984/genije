<div id="panel_edit_account" class="tab-pane">
    <?php 
    echo $this->Form->create('User', array('type' => 'file', 'id' => 'user_form')); 
        $this->Form->inputDefaults(
                array(
                    'error' => array(
                        'attributes' => array(
                            'wrap' => 'span',
                            'class' => 'help-block'
                        )
                    ),
                    'class' => 'form-control',
                    'div' => array(
                        'class' => 'form-group'
                    )
        ));
    ?>
        <div class="row">
            <div class="col-md-12">
                <h3>Uredjivanje naloga: <?php echo $this->data['User']['fullname'] ?></h3>
                <hr>
            </div>
            <div class="col-md-6">
                <?php echo $this->Form->input('first_name', array(
                    'label' => array(
                        'text' => 'Ime',
                        'class' => 'control-label'
                    )
                )) ?>
                <?php echo $this->Form->input('last_name', array(
                    'label' => array(
                        'text' => 'Prezime',
                        'class' => 'control-label'
                    )
                )) ?>
                <?php echo $this->Form->input('email', array(
                    'label' => array(
                        'text' => 'E-mail',
                        'class' => 'control-label'
                    )
                )) ?>
                <?php echo $this->Form->input('phone', array(
                    'label' => array(
                        'text' => 'Telefon',
                        'class' => 'control-label'
                    )
                )) ?>
            </div>
            <div class="col-md-6">
                <div class="form-group connected-group">
                    <label class="control-label">
                        Datum rođenja
                    </label>
                    <div class="row">
                        <div class="col-md-3">
                            <select name="dd" id="dd" class="form-control">
                                <option value="-1">DD</option>
                                <?php for ($i = 1; $i < 31; $i++): ?>
                                    <option value="<?php echo $i ?>" <?php echo $i === $birthday['d'] ? 'selected="selected"' : ''?>><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="mm" id="mm" class="form-control" >
                                <option value="-1">MM</option>
                                <?php for ($i = 1; $i < 13; $i++): ?>
                                    <option value="<?php echo $i ?>" <?php echo $i === $birthday['m'] ? 'selected="selected"' : ''?>><?php echo $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" value="<?php echo $birthday['y']?>" placeholder="<?php echo $birthday['y']?>" id="yyyy" name="yyyy" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Pol
                    </label>
                    <div>
                        <label class="radio-inline">
                            <input type="radio" class="grey" value="" name="data[User][gender]" id="gender_female" <?php echo '2' === $this->request->data['User']['gender'] ? 'checked="checked"' : ''?>>
                            Žensko
                        </label>
                        <label class="radio-inline">
                            <input type="radio" class="grey" value="" name="data[User][gender]"  id="gender_male" <?php echo '1' === $this->request->data['User']['gender'] ? 'checked="checked"' : ''?>>
                            Muško
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    <?php echo $this->Form->input('address', array(
                        'label' => array(
                            'text' => 'Adresa',
                            'class' => 'control-label'
                        )
                    )) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>
                        Promjena slike
                    </label>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 150px; height: 150px;">
                            <img src="<?php echo $slika;?>" />
                        </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 20px;"></div>
                        <div class="user-edit-image-buttons">
                            <span class="btn btn-light-grey btn-file"><span class="fileupload-new">
                                    <i class="fa fa-picture"></i> Odaberi sliku</span>
                                <span class="fileupload-exists"><i class="fa fa-picture"></i> Promjeni</span>
                                <input type="file" name="data[User][img]">
                            </span>
                            <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
                                <i class="fa fa-times"></i> Ukloni
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Dodatne informacije</h3>
                <hr>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">
                        Twitter
                    </label>
                    <span class="input-icon">
                        <input value="<?php echo $this->request->data['User']['twitter'] ?>" name="data[User][twitter]" class="form-control" type="text" placeholder="Text Field">
                        <i class="clip-twitter"></i> 
                    </span>
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Facebook
                    </label>
                    <span class="input-icon">
                        <input value="<?php echo $this->request->data['User']['facebook'] ?>" name="data[User][facebook]" class="form-control" type="text" placeholder="Text Field">
                        <i class="clip-facebook"></i> </span>
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Google Plus
                    </label>
                    <span class="input-icon">
                        <input value="<?php echo $this->request->data['User']['google_plus'] ?>" name="data[User][google_plus]" class="form-control" type="text" placeholder="Text Field">
                        <i class="clip-google-plus"></i> </span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label">
                        Linkedin
                    </label>
                    <span class="input-icon">
                        <input value="<?php echo $this->request->data['User']['linkedin'] ?>" name="data[User][linkedin]" class="form-control" type="text" placeholder="Text Field">
                        <i class="clip-linkedin"></i> </span>
                </div>
                <div class="form-group">
                    <label class="control-label">
                        Skype
                    </label>
                    <span class="input-icon">
                        <input value="<?php echo $this->request->data['User']['skype'] ?>" name="data[User][skype]" class="form-control" type="text" placeholder="Text Field">
                        <i class="clip-skype"></i> </span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div>
                    Potrebna polja
                    <hr>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <p>
                    Klikom na <i>Ažuriraj korisnika</i> potvrđujete tačnost informacija.
                </p>
            </div>
            <div class="col-md-4">
                <?php
                    echo $this->Form->button('Ažuriraj korisnika <i class="fa fa-arrow-circle-right"></i>', array(
                        'class' => 'btn btn-teal btn-block'
                    ));                                
                ?>
            </div>
        </div>
    <?php echo $this->Form->end(); ?>
</div>