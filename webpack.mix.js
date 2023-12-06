/* a frontoffice és a backoffice asset-ek, külön kezeléséhez, generálásához szükséges kettéválasztás:
 *  A webpack.mix.js tartalak a
 *     - webpack.backoffice.mix.js és a
 *     - webpack.frontoffice.mix.js fájlokban vannak.
 */

if (['frontoffice', 'backoffice'].includes(process.env.npm_config_section)) {
    require(`${__dirname}/webpack.${process.env.npm_config_section}.mix.js`);
} else {
    console.log(
        '\x1b[41m%s\x1b[0m',
        'Provide correct --section argument to build command: frontoffice or backoffice'
    );
    throw new Error('Provide correct --section argument to build command!');
}
