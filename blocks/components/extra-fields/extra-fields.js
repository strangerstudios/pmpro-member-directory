function ShowExtraFields( { fields, type } ) {

   if ( fields ) {
        // Empty array to return styled data.
        const custom_fields = [];

        // take all fields and split them twice.
        const fields_array = fields.split(';');

        for( const [index, value] of fields_array.entries() ) {         

        const field_data = value.split(',');
        
        if ( type === 'profile' ) {
            custom_fields.push(
                <div className='pmpro-member-profile-wrapper'>
                  <span className='pmpro-member-profile-subheading'>{field_data[0]}</span><br/>
                  <span className='pmpro-member-profile-content'>{field_data[1]}</span>
                </div>
            );
        } else {
            custom_fields.push(
                <div className='pmpro-member-profile-wrapper'>
                <span className='pmpro-member-profile-subheading'>{field_data[0]}: </span><span className='pmpro-member-profile-content'>{field_data[1]}</span>
                </div>
            );
        }
        

        }

        return custom_fields;
    } else {
        return null;
    }
}

export default ShowExtraFields;