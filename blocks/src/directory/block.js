import DivLayout from './templates/div.js';
import TableLayout from './templates/table.js';
import Col2 from './templates/2col.js';
import Col3 from './templates/3col.js';
import Col4 from './templates/4col.js';

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
            } else if( layout == '2col' ) {
              layout_return.push( 
                <Col2
                  attributes={props.attributes}
                /> 
                );
            } else if( layout == '3col' ) {
              layout_return.push( 
                <Col3
                  attributes={props.attributes}
                /> 
                );
            } else if( layout == '4col' ) {
              layout_return.push(
                <Col4
                  attributes={props.attributes}
                />
              );
            } else {
              layout_return.push(
                <DivLayout 
                    attributes={props.attributes}             
                  />
              )
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
                <TextareaControl 
                  label="Fields"
                  value={ fields }
                  onChange={ fields => { setAttributes( { fields } ) } }
                  help='Accepts a list of label names and metakeys per line. Label,meta_key'
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
                
                <div className="pmpro-member-directory-title" style={{ marginBottom: '2%'}}>
                  <span style={{fontSize: '30px', fontWeight: 'bold'}}>{ __( 'Membership Directory', 'pmpro-member-directory' ) }</span>
                  <div className={ show_search ? '' : 'pmpro-member-directory-hide' } id="pmpro-member-profile-search" style={{ float: 'right' }}>Search Members</div><br/>
                  { show_levels_selected() }   
                </div>

                { show_layout_selected() }

                { isSelected && <em><small style={{color: 'red'}}> {__( 'Example data for reference purposes only. Any resemblance to actual persons, living or dead is purely coincidental.', 'pmpro-member-directory' ) }</small></em> }
              </div> 
          ];
        },
        save: props => {
          return null;
        },
    },
);
