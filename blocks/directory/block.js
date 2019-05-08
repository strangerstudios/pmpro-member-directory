import ShowExtraFields from '../components/extra-fields/extra-fields.js';
import DivLayout from './templates/div.js';
import TableLayout from './templates/table.js';

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

// Dummy Data for up to 4 users:

const dummy_data = [
  { name: 'Andrew Lima', email: 'andrew@email-example.com', level: 'Free', startdate: 'Apr 1, 2019'},
  { name: 'Travis Lima', email: 'travis@email-example.com', level: 'VIP', startdate: 'Feb 12, 2019'},
  { name: 'Jason Coleman', email: 'jason@email-example.com', level: 'Unlimited', startdate: 'Jan 1, 2017'},
  { name: 'Kim Coleman', email: 'kim@email-example.com', level: 'Unlimited', startdate: 'Jan 1, 2017'},
];

export default registerBlockType(
    'pmpro-member-directory/directory',
    {
        title: __( 'Members Directory', 'pmpro-member-directory' ),
        description: __( 'Display a directory of members.', 'pmpro-member-directory' ),
        category: 'pmpro',
         icon: {
            background: '#2997c8',
            foreground: '#ffffff',
            src: 'groups',
         },        
        keywords: [
            __( 'Membership', 'jsforwpblocks' ),
            __( 'User', 'jsforwpblocks' ),
            __( 'Member Directory', 'jsforwpblocks' ),
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
          show_email: {
            type: 'boolean',
            default: true
          }, 
          show_level: {
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
          layout: {
            type: 'string',
          },
          limit: {
            type: 'string'
          },
          link: {
            type: 'boolean',
            default: true
          },
          order: {
            type: 'string',
            default: 'ASC'
          },
          order_by: {
            type: 'string',
            default: 'u.display_name'
          },
        },
        edit: props => {
          const { attributes:  { show_avatar, avatar_size, fields, levels, show_email, show_level, show_search, show_startdate, layout, limit, link, order, order_by },
                className, isSelected, setAttributes } = props;

          const date = moment().format('MMM D, YYYY');  //Figure this out at a later stage.

          function show_layout_selected() {
            const layout_return = [];
            if ( layout == 'div' ) {
              layout_return.push(
                <DivLayout 
                    attributes={props.attributes}             
                  />
              );
            } else if( layout == 'table' ) {
              layout_return.push(
                <TableLayout
                  attributes={props.attributes}
                />
              );
            }

            return layout_return;
          }

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
                title={ __('Display Options', 'pmpro-member-directory' ) }
              >
                <SelectControl
                  multiple
                  label={ __( 'Select levels', 'pmpro-member-directory' ) }
                  help={ __('List of level IDs that allow profiles. Default: All', 'pmpro-member-directory') }
                  value={ levels }
                  onChange={ levels => { setAttributes( { levels } ) } }
                  options={ all_levels }
                />

                <SelectControl 
                  label="Layout"
                  value={ layout }
                  onChange={ layout => { setAttributes( { layout } ) } }
                  options={[
                    { label: __( 'div', 'pmpro-member-directory' ), value: 'div' },
                    { label: __( 'table', 'pmpro-member-directory' ), value: 'table' },
                    { label: __( '2col', 'pmpro-member-directory' ), value: '2col' },
                    { label: __( '3col', 'pmpro-member-directory' ), value: '3col' },
                    { label: __( '4col', 'pmpro-member-directory' ), value: '4col' },
                  ]}
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
                  label='Show Level'
                  checked={ show_level }
                  onChange={ show_level => { setAttributes( { show_level } ) } }
                />

                <CheckboxControl 
                  label='Show Email Address'
                  checked={ show_email }
                  onChange={ show_email => { setAttributes( { show_email } ) } }
                />
                
                <CheckboxControl 
                  label='Show Start Date'
                  checked={ show_startdate }
                  onChange={ show_startdate => { setAttributes( { show_startdate } ) } }
                />

                <CheckboxControl 
                  label="Show Link"
                  checked={ link }
                  onChange={ link => { setAttributes( { link } ) } }
                />
              </PanelBody>

              <PanelBody
                title={ __( 'Extra Fields', 'pmpro-member-directory' ) }
              >
                <TextControl 
                  label="Fields"
                  value={ fields }
                  onChange={ fields => { setAttributes( { fields } ) } }
                  help='Accepts a list of label names and metakeys. i.e. Company,company;Website,user_url'
                />
              </PanelBody>

              <PanelBody
                title={ __( 'Filtering Options', 'pmpro-member-directory' )  }
              >
                <SelectControl 
                  label="Order By"
                  value={ order_by }
                  onChange={ order_by => { setAttributes( { order_by } ) } }
                  options={[
                    { label: __( 'Display Name', 'pmpro-member-directory' ), value: 'u.display_name' },
                    { label: __( 'User Email', 'pmpro-member-directory' ), value: 'u.user_email' },
                    { label: __( 'User Login', 'pmpro-member-directory' ), value: 'u.user_login' },
                    { label: __( 'User Registered', 'pmpro-member-directory' ), value: 'u.user_registered' },
                    { label: __( 'Membership Level', 'pmpro-member-directory' ), value: 'mu.membership_id' },
                    { label: __( 'Membership Start Date', 'pmpro-member-directory' ), value: 'mu.startdate' },
                    { label: __( 'Join Date', 'pmpro-member-directory' ), value: 'joindate`' },
                  ]}
                />

                <SelectControl 
                  label="Order"
                  value={ order }
                  onChange={ order => { setAttributes( { order } ) } }
                  options={[
                    { label: __( 'ASC', 'pmpro-member-directory' ), value: 'ASC' },
                    { label: __( 'DESC', 'pmpro-member-directory' ), value: 'DESC' }, 
                  ]}
                />

                <TextControl 
                  label="Limit"
                  value={ limit }
                  onChange={ limit => { setAttributes( { limit } ) } }
                />
              </PanelBody>
            </InspectorControls>,
              <div className={ className } style={{ fontFamily: 'arial', fontSize: '14px' } }>
                <span style={{fontSize: '30px', fontWeight: 'bold'}}>{ __( 'Membership Directory', 'pmpro-member-directory' ) }</span><br/>
                { show_levels_selected() }             
                
                { show_layout_selected() }
              </div>
          ];
        },
        save: props => {
          return null;
        },
    },
);
