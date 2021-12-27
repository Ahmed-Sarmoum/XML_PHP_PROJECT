<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xs="http://www.w3.org/2001/XMLSchema"
    exclude-result-prefixes="xs" version="1.0">
    
    <xsl:output method="html" indent="yes"/>
    <xsl:template match="/">
        <html>
            <head>List Students AND modules</head>
            <body style="margin-left:280px; margin-right:280px" align="center">
                <xsl:for-each select="//promotion">
                    <h1><xsl:value-of select="@level"/><xsl:value-of select="@option"/></h1>
                    
                </xsl:for-each>
                <hr/>
                <div  style="float:left">
                    <h2>List Students :</h2>
                    <table border="1" align="center">
                        <tr style="background: blue; color:white">
                            <th>Ins Num</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                        </tr>
                        <xsl:for-each select="//student">
                            <tr>
                                <td><xsl:value-of select="@insNum"/></td>
                                <td><xsl:value-of select="@firstname"/></td>
                                <td><xsl:value-of select="@lastname"/></td>
                            </tr>
                        </xsl:for-each>
                    </table> 
                </div>
                
                <div style="float:right">
                    <h2>List Modules :</h2>
                    <table border="1" align="center">
                        <tr style="background: green; color:white">
                            <th>Mod ID</th>
                            <th>Name</th>
                        </tr>
                        <xsl:for-each select="//module">
                            <tr>
                                <td><xsl:value-of select="@modId"/></td>
                                <td><xsl:value-of select="@modName"/></td>
                            </tr>
                        </xsl:for-each>
                    </table>
                </div>                
                
            </body>
        </html>
    </xsl:template>
    
</xsl:stylesheet>