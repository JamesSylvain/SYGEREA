<div class="content">
    <h1><?php if (isset($title)) echo $title; ?></h1>
    <?php if (isset($message)) echo $message; ?>
    <form method="post" action="<?php echo $action; ?>">
        <div class="data">
            <table>
                <tr>
                    <td valign="top">Debit <span style="color:red;">*</span></td>
                    <td>
                        <input type="text"  name="debit" class="inp-form" value="<?php echo set_value('debit', $this->form_data->debit); ?>"/>
                        <?php echo form_error('debit'); ?>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Perimetre de protection<span style="color:red;">*</span></td>
                    <td>
                        <input type="text" name="perimetre_de_protection" class="inp-form" value="<?php echo set_value('perimetre_de_protection', $this->form_data->perimetre_de_protection); ?>"/>
                        <?php echo form_error('perimetre_de_protection'); ?>
                    </td>
                </tr>

                <tr>
                    <td>&nbsp;</td>
                    <td><input type="submit" name="enregistrer" value="Save"/></td>
                </tr>
            </table>
        </div>
    </form>
    <br />
    <?php echo $link_back; ?>
</div>
