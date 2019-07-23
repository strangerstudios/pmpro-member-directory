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
  TextareaControl,
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

          function show_levels_selected() {
            if ( !levels.length ) {
             return null;
            }
             return [
             <span className="pmpro-member-profile-levels" style={{ fontSize: '12px' }}>{ __( 'Levels Selected: ',  'pmpro-member-directory' ) + levels }</span>,
             <br/>
             ]
           }

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
                  help={ __( 'Set this to a user ID to show a profile of a specific user. Leave blank for current user.', 'pmpro-member-directory' ) }
                />

              </PanelBody>
              <PanelBody
                title={ __('Extra Fields', 'pmpro-member-directory' ) }
              >
                <TextareaControl 
                  label="Fields"
                  value={ fields }
                  onChange={ fields => { setAttributes( { fields } ) } }
                  help= { __( 'Accepts a list of label names and metakeys per line. (i.e. Label,meta_key)', 'pmpro-member-directory' ) }
                />
              </PanelBody>
              </InspectorControls>,
              <div className={ className } style={{ fontFamily: 'arial', fontSize: '14px' } }>
                <span style={{fontSize: '30px', fontWeight: 'bold'}}>{ __( 'Membership Profile', 'pmpro-member-directory' ) }</span><div className={ show_search ? '' : 'pmpro-member-directory-hide' } id="pmpro-member-profile-search" style={{ display: 'inline-block', float: 'right'}}>Search Members</div>
                <br/>
                { show_levels_selected() }

                <div className={ show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide' } style={{ width: avatar_size + 'px', height: avatar_size + 'px', display: 'inline-block', float: 'right'}}>{dummy_data[0].icon}</div> 

                <div className={ show_name ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span style={{fontSize: '1.2rem', fontWeight: 'bold'}}>{ __( 'August Dibble', 'pmpro-member-directory' )}</span><br/>
                </div>

                <div className={ show_bio ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>{ __( 'Biographical Info', 'pmpro-member-directory' ) }</span><br/>
                  <span className='pmpro-member-profile-content'>Some biographical information</span>
                </div>
                                            
                <div className={ show_email ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>{ __( 'Email Address', 'pmpro-member-directory' ) }</span><br/>
                  <span className='pmpro-member-profile-content'>{ __( 'August.Dibble@mail.com', 'pmpro-member-directory' ) }</span>
                </div>

                <div className={ show_level ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>{ __('Level', 'pmpro-member-directory' ) }</span><br/>
                  <span className='pmpro-member-profile-content'>{ __( 'Free', 'pmpro-member-directory' )}</span>
                </div>

                <div className={ show_startdate ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>{ __( 'Start Date', 'pmpro-member-directory' ) }</span><br/>
                  <span className='pmpro-member-profile-content'>{ __( 'Jan 21, 2019', 'pmpro-member-directory' )}</span>
                </div>

                <div className={ show_billing ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>{ __( 'Address', 'pmpro-member-directory' ) }</span><br/>
                  <span className='pmpro-member-profile-content'>
                    Di Loreto Park<br/>
                    Witchita<br/>
                    Kansas, 67210<br/>
                    US
                  </span>
                </div>

                <div className={ show_phone ? 'pmpro-member-profile-wrapper' : 'hidden'}>
                  <span className='pmpro-member-profile-subheading'>{ __( 'Phone Number', 'pmpro-member-directory' ) }</span><br/>
                  <span className='pmpro-member-profile-content'>(130) 024-XXX</span>
                </div>

                <ShowExtraFields
                  fields={fields}
                  type="profile"
                />
                
                { isSelected && <em><small style={{color: 'red'}}> {__( 'Example data for reference purposes only. Any resemblance to actual persons, living or dead is purely coincidental.', 'pmpro-member-directory' ) }</small></em> }
            </div>
          ];
        },
        save: props => {
          return null;
        },
    },
);
