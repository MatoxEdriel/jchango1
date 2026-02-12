<?php
class InvoiceDTO {
    public $id;
    public $user_id;
    public $user_name; // Para mostrar quién compró
    public $total_amount;
    public $status;
    public $created_at;

    public function __construct($id, $user_id, $user_name, $total_amount, $status, $created_at) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->total_amount = $total_amount;
        $this->status = $status;
        $this->created_at = $created_at;
    }
}
?>