import { Component } from 'react';
import ShowExtraFields from '../../components/extra-fields/extra-fields';
import dummy_data from '../../components/dummy-data/dummy-data';

const { __ } = wp.i18n;

class TableLayout extends Component {

    render() {
        const { attributes:  { show_avatar, avatar_size, fields, levels, show_email, show_level, show_startdate, layout, link } } = this.props;

        return (
            <table className="pmpro-table" style={{ width: '100%', border: '1px solid black' }}>
                <thead>
                    <th className={ show_avatar ? '' : 'hidden'}>{ __( 'Avatar', 'pmpro-member-directory' ) }</th>
                    <th>{ __( 'Member', 'pmpro-member-directory' ) }</th>
                    <th className={ show_email ? '' : 'hidden' }>{ __( 'Email Address', 'pmpro-member-directory' ) }</th>
                    <th className={ fields ? '' : 'hidden'}>{ __( 'More Information', 'pmpro-member-directory' ) }</th>
                    <th className={ show_level ? '' : 'hidden' }>{ __( 'Level', 'pmpro-member-directory' ) }</th>
                    <th className={ show_startdate ? '' : 'hidden' }>{ __( 'Start Date', 'pmpro-member-directory' ) }</th>
                    <th className={ link ? '' : 'hidden' }>&nbsp;</th>
                </thead>
                <tbody>
                    <tr>
                        <td className={ show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide' }>{dummy_data[0].icon}</td>
                        <td>{dummy_data[0].name}</td>
                        <td className={ show_email ? '' : 'hidden' } >{dummy_data[0].email}</td>
                        <td className={ fields ? '' : 'hidden'}>{<ShowExtraFields  fields={ fields }/>}</td>
                        <td className={ show_level ? '' : 'hidden' }>{dummy_data[0].level}</td>
                        <td className={ show_startdate ? '' : 'hidden' }>{dummy_data[0].startdate}</td>
                        <td className={ link ? '' : 'hidden' }>{ __( 'View Profile', 'pmpro-member-directory' ) }</td>
                    </tr>
                    <tr>
                        <td className={ show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide' }>{dummy_data[1].icon}</td>
                        <td>{dummy_data[1].name}</td>
                        <td className={ show_email ? '' : 'hidden' } >{dummy_data[1].email}</td>
                        <td className={ fields ? '' : 'hidden'}>{<ShowExtraFields  fields={ fields }/>}</td>
                        <td className={ show_level ? '' : 'hidden' }>{dummy_data[1].level}</td>
                        <td className={ show_startdate ? '' : 'hidden' }>{dummy_data[1].startdate}</td>
                        <td className={ link ? '' : 'hidden' }>{ __( 'View Profile', 'pmpro-member-directory' ) }</td>
                    </tr>
                    <tr>
                        <td className={ show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide' }>{dummy_data[2].icon}</td>
                        <td>{dummy_data[2].name}</td>
                        <td className={ show_email ? '' : 'hidden' }>{dummy_data[2].email}</td>
                        <td className={ fields ? '' : 'hidden'}>{<ShowExtraFields  fields={ fields }/>}</td>
                        <td className={ show_level ? '' : 'hidden' }>{dummy_data[2].level}</td>
                        <td className={ show_startdate ? '' : 'hidden' }>{dummy_data[2].startdate}</td>
                        <td className={ link ? '' : 'hidden' }>{ __( 'View Profile', 'pmpro-member-directory' ) }</td>
                    </tr>
                    <tr>
                        <td className={ show_avatar ? 'pmpro-member-directory-icon' : 'pmpro-member-directory-hide' }>{dummy_data[3].icon}</td>
                        <td>{dummy_data[3].name}</td>
                        <td className={ show_email ? '' : 'hidden' }>{dummy_data[3].email}</td>
                        <td className={ fields ? '' : 'hidden'}>{<ShowExtraFields  fields={ fields }/>}</td>
                        <td className={ show_level ? '' : 'hidden' }>{dummy_data[3].level}</td>
                        <td className={ show_startdate ? '' : 'hidden' }>{dummy_data[3].startdate}</td>
                        <td className={ link ? '' : 'hidden' }>{ __( 'View Profile', 'pmpro-member-directory' ) }</td>
                    </tr>
                </tbody>
            </table>
        )
    }
}
export default TableLayout;