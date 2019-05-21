import ShowExtraFields from "../components/extra-fields/extra-fields";
import dummy_data from "../components/dummy-data/dummy-data";

const { __ } = wp.i18n;

const {
  registerBlockType,
} = wp.blocks;

const {
  PanelBody,
  SelectControl,
  TextControl,
  CheckboxControl,
} = wp.components;

const {
  InspectorControls,
} = wp.editor;

const all_levels = pmpro.all_level_values_and_labels;

export default registerBlockType(
    'pmpro-member-directory/profile',
    {
        title: __( 'Member Profile', 'pmpro-member-directory' ),
        description: __( 'Display a profile for a Member.', 'pmpro-member-directory' ),
        category: 'pmpro',
         icon: {
            background: '#2997c8',
            foreground: '#ffffff',
            src: 'admin-users',
         },        
        keywords: [
            __( 'Membership', 'jsforwpblocks' ),
            __( 'User', 'jsforwpblocks' ),
            __( 'Member Profile', 'jsforwpblocks' ),
        ],
        attributes: {
          avatar_size: {
            type: 'string',
            default: '128'
          },
          fields: {
            type: 'string',
            default: ''
          },
          levels: {
            type: 'array',
            default: ''
          },
          show_avatar: {
            type: 'boolean',
            default: true
          },
          show_bio: {
            type: 'string',
            default: 'true'
          },
          show_billing: {
            type: 'boolean',
            default: true
          },
          show_email: {
            type: 'boolean',
            default: true
          },
          show_name: {
            type: 'boolean',
            default: true
          },  
          show_level: {
            type: 'boolean',
            default: true
          },
          show_phone: {
            type: 'boolean',
            default: true
          },
          show_search: {
            type: 'boolean',
            default: true
          },
          show_startdate: {
            type: 'boolean',
            default: true
          },
          user_id: {
            type: 'string',
            default: ''
          },
        },
        edit: props => {
          const { attributes:  { avatar_size, fields, levels, show_avatar, show_bio, show_billing, show_email, show_name, show_level, show_phone, show_search, show_startdate, user_id },
          className, isSelected, setAttributes } = props;

          return [
            isSelected && <InspectorControls>
              <PanelBody
                title={ __( 'Display Settings', 'pmpro-member-directory' ) }
              >
                <SelectControl
                  multiple
                  label={ __( 'Select levels', 'pmpro-member-directory' ) }
                  help={ __('List of level IDs that allow profiles. Default: All', 'pmpro-member-directory') }
                  value={ levels }
                  onChange={ levels => { setAttributes( { levels } ) } }
                  options={ all_levels }
                />

                <CheckboxControl 
                  label='Show Search'
                  checked={ show_search }
                  onChange={ show_search => { setAttributes( { show_search } ) } }
                />

                <CheckboxControl 
                  label="Show Avatar"
                  checked={ show_avatar }
                  onChange={ show_avatar => { setAttributes( { show_avatar } ) } }
                />
             
                <TextControl 
                  label="Avatar Size"
                  value={ avatar_size }
                  className={ !show_avatar ? "hidden" : "" }
                  onChange={ avatar_size => { setAttributes( { avatar_size } ) } }
                />

                <CheckboxControl 
                  label='Show Bio'
                  checked={ show_bio }
                  onChange={ show_bio => { setAttributes( { show_bio } ) } }
                />

                <CheckboxControl 
                  label='Show Level'
                  checked={ show_level }
                  onChange={ show_level => { setAttributes( { show_level } ) } }
                />

                <CheckboxControl 
                  label='Show Billing'
                  checked={ show_billing }
                  onChange={ show_billing => { setAttributes( { show_billing } ) } }
                />
                <CheckboxControl 
                  label='Show Email Address'
                  checked={ show_email }
                  onChange={ show_email => { setAttributes( { show_email } ) } }
                />

                <CheckboxControl 
                  label='Show Name'
                  checked={ show_name }
                  onChange={ show_name => { setAttributes( { show_name } ) } }
                />

                <CheckboxControl 
                  label='Show Phone'
                  checked={ show_phone }
                  onChange={ show_phone => { setAttributes( { show_phone } ) } }
                />

                <CheckboxControl 
                  label='Show Start Date'
                  checked={ show_startdate }
                  onChange={ show_startdate => { setAttributes( { show_startdate } ) } }
                />

                <TextControl 
                  label="User ID"
                  value={ user_id }
                  onChange={ user_id => { setAttributes( { user_id } ) } }
                  help='Set this to a user ID to show a profile of a specific user. Leave blank for current user.'
                />

              </PanelBody>
              <PanelBody
                title={ __('Extra Fields', 'pmpro-member-directory' ) }
              >
                <TextControl 
                  label="Fields"
                  value={ fields }
                  onChange={ fields => { setAttributes( { fields } ) } }
                  help='Accepts a list of label names and metakeys. i.e. Company,company;Website,user_url'
                />
              </PanelBody>
              </InspectorControls>,
              <div className={ className } style={{ fontFamily: 'arial', fontSize: '14px' } }>
                <span style={{fontSize: '30px', fontWeight: 'bold'}}>{ __( 'Membership Profile', 'pmpro-member-directory' ) }</span><br/>
                <span className="pmpro-member-profile-levels" style={{ fontSize: '12px' }}>{ __( 'Levels Selected: ',  'pmpro-member-directory' ) + levels }</span><br/>
               
                <div style={{float:'right'}}>
                  <div className={ show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide' } style={{ width: avatar_size + 'px', height: avatar_size + 'px', display: 'inline-block'}}>{dummy_data[0].icon}</div> 
                  <div className={ show_search ? '' : 'pmpro-member-directory-hide' } id="pmpro-member-profile-search" style={{ display: 'inline-block'}}>Search Members</div>
                </div>


                <div className={ show_name ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span style={{fontSize: '24px', fontWeight: 'bold'}}>{dummy_data[0].name}</span><br/>
                </div>

                <div className={ show_bio ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>Biographical Info</span><br/>
                  <span className='pmpro-member-profile-content'>Some biographical information</span>
                </div>
                                            
                <div className={ show_email ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>Email Address</span><br/>
                  <span className='pmpro-member-profile-content'>{dummy_data[0].email}</span>
                </div>

                <div className={ show_level ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>Level</span><br/>
                  <span className='pmpro-member-profile-content'>{dummy_data[0].level}</span>
                </div>

                <div className={ show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>Start Date</span><br/>
                  <span className='pmpro-member-profile-content'>{dummy_data[0].startdate}</span>
                </div>

                <div className={ show_billing ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>Address</span><br/>
                  <span className='pmpro-member-profile-content'>
                    195 Jan Smuts Avenue<br/>
                    Rosebank<br/>
                    Johannesburg, Gauteng 2196<br/>
                    ZA
                  </span>
                </div>

                <div className={ show_phone ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>Phone Number</span><br/>
                  <span className='pmpro-member-profile-content'>(072) 685-8234</span>
                </div>

                <ShowExtraFields
                  fields={fields}
                  type="profile"
                />

            </div>
          ];
        },
        save: props => {
          return null;
        },
    },
);
