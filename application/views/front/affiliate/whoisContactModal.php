<!-------------MODAL------------>
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title blue" style="color:#2196F3;">Domain Info</h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h4>Registrant Contact Info</h4>
            <ul>
                <li>Registrant Contact Full Name : <?php if(isset($registrant_contact_full_name)){ echo $registrant_contact_full_name; } ?></li>
                <li>Registrant Contact Company Name : <?php if(isset($registrant_contact_company_name)){ echo $registrant_contact_company_name; } ?></li>
                <li>Registrant Contact Country Name : <?php if(isset($registrant_contact_country_name)){ echo $registrant_contact_country_name; } ?></li>
            </ul>
            <h4>Administrative Contact Info</h4>
            <ul>
                <li>Administrative Contact Company Name : <?php if(isset($administrative_contact_company_name)){ echo $administrative_contact_company_name; } ?></li>
                <li>Administrative Contact Mailing Address : <?php if(isset($administrative_contact_mailing_address)){ echo $administrative_contact_mailing_address; } ?></li>
                <li>Administrative Contact Email Address : <?php if(isset($administrative_contact_email_address)){ echo $administrative_contact_email_address; } ?></li>
            </ul>
            <h4>Technical Contact Info</h4>
            <ul>
                <li>Technical Contact Company Name : <?php if(isset($technical_contact_company_name)){ echo $technical_contact_company_name; } ?></li>
                <li>Technical Contact Mailing Address : <?php if(isset($technical_contact_mailing_address)){ echo $technical_contact_mailing_address; } ?></li>
                <li>Technical Contact Email Address : <?php if(isset($technical_contact_email_address)){ echo $technical_contact_email_address; } ?></li>
            </ul>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->