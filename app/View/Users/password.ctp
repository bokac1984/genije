<?php
$root = $this->Html->link('Korisnici', array('controller' => 'users', 'action' => 'index'));

$this->assign('page-breadcrumbroot', $root );
$this->assign('crumb', 'Promjena šifre' );

$this->assign('title', 'Korisnici');
$this->assign('page-title', 'Korisnici <small>promjena šifre</small>');
?>
<div class="row">
  <div class="col-md-5">
      <h4>Oba polja su obavezna da se unesu</h4>
    <?php
        echo $this->Form->create('User', array(
            'plugin' => null,
            'controller' => 'users',
            'action' => 'password',
            'method' => 'post'
        ));
        $this->Form->inputDefaults(array(
                'error' => array(
                    'attributes' => array(
                        'wrap' => 'span',
                        'class' => 'help-block'
                    )
                ),

            )
        );   
        echo $this->Form->input('password', array(
            'class' => 'form-control',
            'type' => 'password',
            'placeholder' => 'Nova šifra',
            'label' => false,
            'div' => 'form-group '.($this->Form->isFieldError('password') ? 'has-error' : '')
        ));
        echo $this->Form->input('password2', array(
            'class' => 'form-control',
            'type' => 'password',
            'placeholder' => 'Nova šifra ponovo',
            'label' => false,
            'div' => 'form-group '.($this->Form->isFieldError('password2') ? 'has-error' : '')
        ));
        
        echo $this->Form->button('Ažuriraj <i class="fa fa-arrow-circle-right"></i>', 
                array(
                    'type' => 'submit', 
                    'class' => 'btn btn-teal btn-block'
            ));
        echo $this->Form->end();
    ?>
  </div>
    <div class="col-md-7">
        <h4>Savjeti kod odabira lozinke</h4>
        <ul>
            <li>Šifra neka bude različita od korisničkog imena</li>
            <li>Pri odabiru šifre voditi računa da istu ne koristiš već na nekim drugim internet stranicama</li>
            <li>Naša preporuka je da u šifru uključiš kombinaciju velikih i malih slova, brojeva i znakova (!, ?, @, # itd.) i pokušaj izbjegavati lične podatke koje bi neko ko te poznaje mogao slučajno pogoditi (datum rođenja, ime djeteta, kućnog ljubimca, učitelja iz osnovne škole i slično).</li>
        </ul>
        <p>Korisnik je dužan brinuti se o sigurnosti svoje šifre i povremeno je mijenjati. Urban Genie ne odgovara za slučajeve zloupotrebe korisničke šifre, ali će odmah nakon što korisnik obavijesti o vjerovatnoj zloupotrebi odgovarajuće i postupiti.</p>
    </div>
</div>
