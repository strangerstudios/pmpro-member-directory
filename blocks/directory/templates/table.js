import { Component } from 'react';
import ShowExtraFields from '../../components/extra-fields/extra-fields';

const { __ } = wp.i18n;

class TableLayout extends Component {

    render() {
        const { attributes:  { show_avatar, avatar_size, fields, levels, show_email, show_level, show_search, show_startdate, layout, link } } = this.props;

        return (
            <table className="pmpro-table" style={{ width: '100%', border: '1px solid black' }}>
                <thead>
                    <th>{ __( 'Avatar', 'pmpro-member-directory' ) }</th>
                    <th>{ __( 'Member', 'pmpro-member-directory' ) }</th>
                    <th>{ __( 'Email Address', 'pmpro-member-directory' ) }</th>
                    <th>{ __( 'More Information', 'pmpro-member-directory' ) }</th>
                    <th>{ __( 'Level', 'pmpro-member-directory' ) }</th>
                    <th>{ __( 'Start Date', 'pmpro-member-directory' ) }</th>
                    <th>Profile</th>
                </thead>
                <tbody>
                    <tr>
                        <td id="pmpro-member-directory-placeholder" style={{ width: '40px', height: '40px'}}>&nbsp;</td>
                        <td>Member</td>
                        <td>email@email.com</td>
                        <td>Field:something</td>
                        <td>Free Level</td>
                        <td>May 8, 2019</td>
                        <td>Profile Link</td>
                    </tr>
                    <tr>
                        <td id="pmpro-member-directory-placeholder" style={{ width: '40px', height: '40px'}}>&nbsp;</td>
                        <td>Member</td>
                        <td>email@email.com</td>
                        <td>Field:something</td>
                        <td>Free Level</td>
                        <td>May 8, 2019</td>
                        <td>Profile Link</td>
                    </tr>
                    <tr>
                        <td id="pmpro-member-directory-placeholder" style={{ width: '40px', height: '40px'}}>&nbsp;</td>
                        <td>Member</td>
                        <td>email@email.com</td>
                        <td>Field:something</td>
                        <td>Free Level</td>
                        <td>May 8, 2019</td>
                        <td>Profile Link</td>
                    </tr>
                    <tr>
                        <td id="pmpro-member-directory-placeholder" style={{ width: '40px', height: '40px'}}>&nbsp;</td>
                        <td>Member</td>
                        <td>email@email.com</td>
                        <td>Field:something</td>
                        <td>Free Level</td>
                        <td>May 8, 2019</td>
                        <td>Profile Link</td>
                    </tr>
                </tbody>
            </table>
        )
    }
}
export default TableLayout;