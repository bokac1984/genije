<p>
<?php
if ($this->Paginator->hasNext() || $this->Paginator->hasPrev()) {
//echo $this->Paginator->counter(array(
//'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
//));
?>	
</p>
<div >
    <ul class="pagination">
        <?php
        echo $this->Paginator->prev('< ', array('tag' => 'li'), null, array('class' => 'prev disabled', 'tag' => 'li', 'disabledTag' => 'a'));
        echo $this->Paginator->first("<<", array(
            'tag' => 'li'
        ));
        echo $this->Paginator->numbers(array(
                        'separator' => '', 
                        'tag' => 'li',
                        'currentClass' => 'active',
                        'currentTag' => 'a'
                    )
                );
        echo $this->Paginator->last(">>", array(
            'tag' => 'li'
        ));
        echo $this->Paginator->next(' >', array('tag' => 'li'), null, array('class' => 'next disabled', 'tag' => 'li', 'disabledTag' => 'a'));          
        ?>
    </ul>
</div>
<?php } ?>