<?php
	Yii::import('zii.widgets.grid.CGridView');

    class ActGridView extends CGridView {
    //This does depend on your data structure
   // $data=$this->dataProvider->data;
    //$id = $data['id']; //(This may be an object I have not checked is so: $data->id)

        public function renderTableRow($row)
        {
        	$data=$this->dataProvider->data[$row];
        	$ev = ($data["eigenVervoer"] == 0) ? "Nee" : "Ja";
        	$i = 0;

            echo '<tr>';
            foreach($this->columns as $column){
            	$i++;
                $column->renderDataCell($row);
            }
            echo "</tr>\n";
			
			echo '<tr class="tableDetailRow  activeDisplay" >';
                echo '<td colspan='.$i.'>
                		<table>
                			<tbody>
                				<tr>
                					<td><b>Aangemeld op</b></td>
                					<td>'.$data["datumAanmelding"].'</td>
                				</tr>
                				<tr>
                					<td><b>Eigen vervoer</b></td>
                					<td>'.$ev.'</td>
                				</tr>
                			</tbody>
                		</table>
                	</td>';
            echo "</tr>\n";
        }

    }