<?php
/**
 * [ADMIN] ExamplePlugin
 */
?>
<?php echo $this->BcForm->create('ExamplePlugin', ['url' => ['action' => 'form']]); ?>

<div class="section">
	<table cellpadding="0" cellspacing="0" class="form-table bca-form-table" id="FormTable">
		<tbody>
			<tr>
				<th class="col-head bca-form-table__label">
					<?php echo $this->BcForm->label('ExamplePlugin.title', '項目名') ?>
					&nbsp;<span class="bca-label required size-small" data-bca-label-type="required"><?php echo __d('baser', '必須') ?></span>
				</th>
				<td class="col-input bca-form-table__input">
					<?php echo $this->BcForm->input('ExamplePlugin.title', [
						'type' => 'text', 'size' => 50, 'maxlength' => 230, 'counter' => true,
					]) ?>
					<?php echo $this->BcForm->error('ExamplePlugin.title') ?>
				</td>
			</tr>
			<tr>
				<th class="col-head bca-form-table__label">
					<?php echo $this->BcForm->label('ExamplePlugin.description', '内容') ?>
				</th>
				<td class="col-input bca-form-table__input">
					<?php echo $this->BcForm->input('ExamplePlugin.description', ['type' => 'textarea', 'cols' => 60, 'rows' => 5]) ?>
					<?php echo $this->BcForm->error('ExamplePlugin.description') ?>
				</td>
			</tr>
			<tr>
				<th class="col-head bca-form-table__label">
					<?php echo $this->BcForm->label('ExamplePlugin.status', '状態') ?>
				</th>
				<td class="col-input">
					<?php echo $this->BcForm->input('ExamplePlugin.status', ['type' => 'radio', 'options' => [0 => '不可', 1 => '可'], 'default' => 0]) ?>
					<?php echo $this->BcForm->error('ExamplePlugin.status') ?>
				</td>
			</tr>
		</tbody>
	</table>

	<div class="submit bca-actions">
		<?php echo $this->BcForm->submit('保　存', [
			'div' => false, 'class' => 'button bca-btn bca-actions__item',
			'data-bca-btn-type' => 'save', 'data-bca-btn-size' => 'lg', 'data-bca-btn-width' => 'lg', 'id' => 'BtnSave',
			'onClick'=>"return confirm('本当に保存して良いですか？')",
		]); ?>
	</div>
</div>

<?php echo $this->BcForm->end(); ?>
